<?php
namespace App\Controller ;

use App\Entity\User ;
use App\Entity\RefreshToken ;
use Doctrine\ORM\EntityManagerInterface ;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface ;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\JsonResponse ;
use Symfony\Component\HttpFoundation\Request ;

class AuthController extends __MyRootController
{
  private $em ;

  public function __construct( EntityManagerInterface $em ) {
    $this->em = $em ;

  }

  /**
    * @Route("/api/register", name="register", methods={"POST"})
    * @param Request $request
    * @param UserPasswordHasherInterface $pwdHasher
    * @return JsonResponse
    */
  public function register(Request $request, UserPasswordHasherInterface $pwdHasher): JsonResponse {
    $request = $this->transformJsonBody($request) ;

    $this->captchaEngine() ;
    if ( $this->captchaEngine( $request->get('username') ) ) {
      return $this->respondAsSuccess( $request->get('username') ) ;
    }
    return $this->respondAsSuccess('done') ;

    // $request = $this->transformJsonBody($request) ;
    $username = $request->get('username') ;
    $password = $request->get('password') ;
    $secureKey = $request->get('secureKey') ;
    $email = $request->get('email') ;
    $walletAddr = $request->get('walletAddr') ;
    $country = $request->get('country') ;
    $captcha = $request->get('captcha') ;
    if ( ! $this->validateCaptchaCode($captcha) ) {
      return $this->errorResponseCode(422) ;
    }

    try {
      $user = new User();
      $user->setUsername($username) ;
      $user->setPassword( $pwdHasher->hashPassword($user, $password) ) ;
      $user->setEmail($email) ;
      $user->setRoles( ['ROLE_USER'] ) ;

      $this->em->persist($user) ;
      $this->em->flush() ;

      return $this->respondAsSuccess('received') ;
    } catch (\Exception $e) {
      return $this->errorResponseCode(422) ;
    }
  }

  /**
    * @Route("/api/captcha/gen", name="generate_captcha", methods={"POST"})
    * @desc Function to generate a captcha image. The generated captcha image URI
    * is stored in $_COOKIE['capImgUri'] thanks to $this->captchaEngine()
    * @param Request $request
    * @return JsonResponse
    */
  public function generateCaptcha(Request $request): JsonResponse {
    $request = $this->transformJsonBody($request) ;

    $this->captchaEngine() ;
    return $this->respondAsSuccess('done!') ;
  }

  /**
    * @Route("/api/captcha/validate", name="validate_captcha", methods={"POST"})
    * @desc Function to generate a captcha image. The generated captcha image URI
    * is stored in $_COOKIE['capImgUri'] thanks to $this->captchaEngine()
    * @param Request $request
    * @return JsonResponse 'correct' if $captchaCode is correct. Else 'error'
    */
  public function validateCaptcha(Request $request): JsonResponse {
    $request = $this->transformJsonBody($request) ;

    $captchaCode = $request->get('captcha') ;
    $validUserEntry = $this->captchaEngine( $captchaCode ) ;
    $this->captchaEngine() ;
    if ( $validUserEntry === true ) {
      return $this->respondAsSuccess('correct') ;
    }

    return $this->respondAsSuccess('error') ;
  }

  /**
    * @Route("/auth/login", name="login", methods={"POST"})
    * @param UserInterface $user
    * @param JWTTokenManagerInterface $JWTManager
    * @return JsonResponse
    */
  public function login(Request $request, UserPasswordHasherInterface $pwdHasher, JWTTokenManagerInterface $JWTManager): JsonResponse {
    $request = $this->transformJsonBody($request) ;
    $username = $request->get('username') ;
    $password = $request->get('password') ;
    if (empty($username) || empty($password)) {
      return $this->errorResponseCode(422) ;
    }
   
    try {
      $repository = $this->em->getRepository(User::class) ;
      // get the username from db
      $user = $repository->findOneBy(['userIdentifier' => $username]) ;
      if (!$user) {
        return $this->errorResponseCode(404) ;
      }
      // Verify the login password
      if ( $pwdHasher->isPasswordValid($user, $password) ) {
        // function to generate jwt access token that expires in 5 minutes

        // function to generate refresh token that expires in 7 days

        // store the refresh token to this users DB

        // set both the access and refresh token to the client cookie

        // return new JsonResponse($user->getCreatedAt());
        return new JsonResponse(['token' => $JWTManager->create($user)]) ;
        // dd($user) ;

      } else { 
        return $this->errorResponseCode(422) ; 
      }
    } catch ( \Exception $e ) {
      return $this->errorResponseCode(422) ;
    }


  }

  /**
    * @Route("/api/logout", name="logout", methods={"PUT"})
    * @return JsonResponse
    */
  public function logout() {
    // first remove the refresh_token from db
    if (isset($_COOKIE['refresh_'])) {
      $refreshTokVal = $_COOKIE['refresh_'];
      try {
        $str = "DELETE FROM refresh_tokens WHERE refresh_token = ?";
        $stmt = $this->getConn()->prepare($str);
        $stmt->bindParam(1, $refreshTokVal);
        $result = $stmt->executeStatement();
      } catch (\Exception $e) { /* do nothing */ }
    }
    // drop both access and refresh tokens from cookie
    setcookie("access_", "", time() - 3600, "/"); /* drop access cookie */
    setcookie("refresh_", "", time() - 3600, "/"); /* drop refresh cookie */

    return $this->respondAsSuccess('Logged out successfully!') ;
  }



}



?>
