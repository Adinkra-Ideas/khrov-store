<?php
namespace App\Controller ;

use Symfony\Component\HttpFoundation\JsonResponse ;
use Symfony\Component\HttpFoundation\Request ;

class CaptchaController extends __MyRootController
{
  // private $em ;

  // public function __construct( EntityManagerInterface $em ) {
  //   $this->em = $em ;

  // }

  /**
    * @Route("/captcha/gen", name="generate_captcha", methods={"POST"})
    * @desc Function to generate a captcha image. The generated captcha image URI
    * is stored in $_COOKIE['capImgUri'] thanks to $this->captchaEngine()
    * and the path is returned as a string
    * @return JsonResponse
    */
  public function generateCaptcha(): JsonResponse {
    $captchaImg = $this->captchaEngine() ;
    return $this->respondAsSuccess($captchaImg) ;
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
    // $this->captchaEngine() ;
    if ( $validUserEntry === 'correct' ) {
      return $this->respondAsSuccess('correct!') ;
    }
    return $this->errorResponseCode(422) ;
  }

    /**
     * #A. If this function is called without a $captchaCode arg, then it is assumed
     * that we are generating a captcha image. It simply selects one captcha image 
     * from /public/captcha directory and sets the image URI to $_COOKIE['capImgUri'].
     * #B. But if it is called with a $captchaCode arg, then it is assumed that we
     * are verifying a user-submitted $captchCode. We will compare the user-submitted
     * $captchCode against the active Captcha Image Uri in their $_COOKIE['capImgUri'].
     * If correct same with the user-provided captcha code in @param string $success
     * @param string $captcha is user-provided captcha code
     * @return bool 'true' if #B happened and the user-submitted $captchCode is same
     * with the active Captcha Image Uri in their $_COOKIE['capImgUri']. 'false' in every
     * other situation
     */
  protected function captchaEngine(string $captchaCode = ''): string {
    $captchaDir = '/captcha/' ;
    $capImgUri = array();
    $capImgUri['284']= $captchaDir . 'gen1.png';
    $capImgUri['392']= $captchaDir . 'gen2.png';
    $capImgUri['949']= $captchaDir . 'gen3.png';
    $capImgUri['865']= $captchaDir . 'gen4.png';
    $capImgUri['648']= $captchaDir . 'gen5.png';
    $capImgUri['529']= $captchaDir . 'gen6.png';
    $capImgUri['833']= $captchaDir . 'gen7.png';
    $capImgUri['924']= $captchaDir . 'gen8.png';
    $capImgUri['449']= $captchaDir . 'gen9.png';
    $capImgUri['492']= $captchaDir . 'gen10.png';
    $capImgUri['952']= $captchaDir . 'gen11.png';
    $capImgUri['486']= $captchaDir . 'gen12.png';
    $capImgUri['366']= $captchaDir . 'gen13.png';
    $capImgUri['462']= $captchaDir . 'gen14.png';
    $capImgUri['955']= $captchaDir . 'gen15.png';
    $capImgUri['943']= $captchaDir . 'gen16.png';
    $capImgUri['228']= $captchaDir . 'gen17.png';
    $capImgUri['984']= $captchaDir . 'gen18.png';
    $capImgUri['963']= $captchaDir . 'gen19.png';
    $capImgUri['349']= $captchaDir . 'gen20.png';

    if ( strlen($captchaCode) > 0 ) { //B
      if ( isset($_COOKIE['capImgUri']) ) {
        $activeCaptcha = $_COOKIE['capImgUri'] ;
        if ( isset( $capImgUri[$captchaCode] )
          && $capImgUri[$captchaCode] === $activeCaptcha) {
          return 'correct';
        } else {
          return 'failed';
        }
      }
    }

    $i = rand(0,19) ;
    $activeCaptcha = array_rand($capImgUri) ;
    setcookie(
      "capImgUri", 
      "$capImgUri[$activeCaptcha]", 
      time()+3600, 
      "/", 
      // $this->getParameter( name: 'frontend_url' ), 
      // true, 
      // true
      );
    return $capImgUri[$activeCaptcha];
  }

}



?>
