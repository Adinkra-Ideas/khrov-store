<?php
// Attempt to first search /src/Controller for any unknown class not included with 'use'
namespace App\Controller ;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController ;
use Symfony\Component\HttpFoundation\JsonResponse ;
use Symfony\Component\HttpFoundation\Request ;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Tools\DsnParser;
use Doctrine\DBAL\Connection;

  class __MyRootController extends AbstractController
  {
    /**
     * @var integer HTTP status code - 200 by default
     */
    protected $statusCode = 200 ;

    /**
     * Gets the value of $conn
     *
     * @return Connection
     */
    protected function getConn(): Connection {
      $dsnParser = new DsnParser(['mysql' => 'mysqli', 'postgres' => 'pdo_pgsql']);
      $connectionParams = $dsnParser->parse( $_SERVER['DATABASE_URL'] );
      $conn = DriverManager::getConnection($connectionParams);
      return $conn ;
    }

    /**
     * Gets the value of $statusCode.
     *
     * @return integer
     */
    protected function getStatusCode(): int {
      return $this->statusCode ;
    }
    /**
     * Sets the value of $statusCode.
     *
     * @param integer $statusCode the status code
     *
     * @return self
     */
    protected function setStatusCode(int $statusCode): __MyRootController {
        $this->statusCode = $statusCode ;
        return $this ;
    }


    /**
     * Returns a JSON response
     *
     * @param array $data
     * @param array $headers
     *
     * @return JsonResponse
     */
    protected function respondAsCompleted($data, $headers = []): JsonResponse {
        return new JsonResponse($data, $this->getStatusCode(), $headers) ;
    }
    /**
     * Returns a 20X Created
     *
     * @param array $data
     *
     * @return JsonResponse
     */
    protected function completedResponse($data = []): JsonResponse {
        return $this->setStatusCode(201)->respondAsCompleted($data) ;
    }


    /**
     * Sets an error value and returns a JSON response
     *
     * @param string $errors
     * @param array $headers
     * @return JsonResponse
     */
    protected function respondAsError(string $errorMessage, $headers = []): JsonResponse {
      $data = [
        'status' => $this->getStatusCode(),
        'message' => $errorMessage,
      ] ;
      return new JsonResponse($data, $this->getStatusCode(), $headers) ;
    }
    /**
     * Sets a HTTP error code and returns it as a JSON response
     *
     * @param int $errorCode HTTP error code for building the json response
     * @return JsonResponse
     */
    protected function errorResponseCode(int $errorCode) : JsonResponse {
      switch ($errorCode) {
        case 401:
          return $this->setStatusCode($errorCode)->respondAsError('Unauthorized!') ;
        case 404:
          return $this->setStatusCode($errorCode)->respondAsError('Not Found!') ;
        case 422:
          return $this->setStatusCode($errorCode)->respondAsError('User Data Validation Errors!') ;
      }
    }


    /**
     * Sets a success value and returns a JSON response
     *
     * @param string $success
     * @param array $headers
     * @return JsonResponse
     */
    protected function respondAsSuccess(string $successMessage, $headers = []): JsonResponse {
      $data = [
        'status' => $this->getStatusCode(),
        'message' => $successMessage,
      ] ;
      return new JsonResponse($data, $this->getStatusCode(), $headers) ;
    }


    protected function transformJsonBody(Request $req): Request {
      $data = json_decode($req->getContent(), true) ;

      if ($data === null) {
        return $req ;
      }

      $req->request->replace($data) ;
      return $req ;
    }

    // /**
    //  * #A. If this function is called without a $captchaCode arg, then it is assumed
    //  * that we are generating a captcha image. It simply selects one captcha image 
    //  * from /public/captcha directory and sets the image URI to $_COOKIE['capImgUri'].
    //  * #B. But if it is called with a $captchaCode arg, then it is assumed that we
    //  * are verifying a user-submitted $captchCode. We will compare the user-submitted
    //  * $captchCode against the active Captcha Image Uri in their $_COOKIE['capImgUri'].
    //  * If correct same with the user-provided captcha code in @param string $success
    //  * @param string $captcha is user-provided captcha code
    //  * @return bool 'true' if #B happened and the user-submitted $captchCode is same
    //  * with the active Captcha Image Uri in their $_COOKIE['capImgUri']. 'false' in every
    //  * other situation
    //  */
    // protected function captchaEngine(string $captchaCode = ''): bool {
    //   $captchaDir = '/captcha/' ;
    //   $capImgUri = array();
    //   $capImgUri['284']= $captchaDir . 'gen1.png';
    //   $capImgUri['392']= $captchaDir . 'gen2.png';
    //   $capImgUri['949']= $captchaDir . 'gen3.png';
    //   $capImgUri['865']= $captchaDir . 'gen4.png';
    //   $capImgUri['648']= $captchaDir . 'gen5.png';
    //   $capImgUri['529']= $captchaDir . 'gen6.png';
    //   $capImgUri['833']= $captchaDir . 'gen7.png';
    //   $capImgUri['924']= $captchaDir . 'gen8.png';
    //   $capImgUri['449']= $captchaDir . 'gen9.png';
    //   $capImgUri['492']= $captchaDir . 'gen10.png';
    //   $capImgUri['952']= $captchaDir . 'gen11.png';
    //   $capImgUri['486']= $captchaDir . 'gen12.png';
    //   $capImgUri['366']= $captchaDir . 'gen13.png';
    //   $capImgUri['462']= $captchaDir . 'gen14.png';
    //   $capImgUri['955']= $captchaDir . 'gen15.png';
    //   $capImgUri['943']= $captchaDir . 'gen16.png';
    //   $capImgUri['228']= $captchaDir . 'gen17.png';
    //   $capImgUri['984']= $captchaDir . 'gen18.png';
    //   $capImgUri['963']= $captchaDir . 'gen19.png';
    //   $capImgUri['349']= $captchaDir . 'gen20.png';

    //   if ( strlen($captchaCode) === 0 ) { #A
    //     $i = rand(0,19) ;
    //     $activeCaptcha = array_rand($capImgUri) ;
    //     setcookie(
    //       "capImgUri", 
    //       "$capImgUri[$activeCaptcha]", 
    //       time()+3600, 
    //       "/", 
    //       // $this->getParameter( name: 'frontend_url' ), 
    //       // true, 
    //       // true
    //     );
    //   } else { #B
    //     if ( isset($_COOKIE['capImgUri']) ) {
    //       $activeCaptcha = $_COOKIE['capImgUri'] ;
    //       if ( isset( $capImgUri[$captchaCode] )
    //           && $capImgUri[$captchaCode] === $activeCaptcha) {
    //         return true;
    //       }
    //     }
    //   }

    //   return false;
    // }

    






  }

?>
