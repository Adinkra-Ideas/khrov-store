<?php
namespace App\Controller ;

use Symfony\Component\HttpFoundation\JsonResponse ;
use Symfony\Component\HttpFoundation\Request ;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface ;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface ;

  class LuckyController extends __MyRootController
  {
    /** @var JWTTokenManagerInterface
     * used for accessing the lexik jwt manager methods
     */
    private  $jwtManager;

    /** @var TokenStorageInterface
     * used for storing the raw token retrieved from client request
     */
    private $rawJwtToken;

    private $decodedJwtToken;

    /**
     * @param TokenStorageInterface $tokenStorageInterface
     * @param JWTTokenManagerInterface $jwtManager
     */
    public function __construct(TokenStorageInterface $tokenStorageInterface, JWTTokenManagerInterface $jwt) {
      $this->jwtManager = $jwt;
      $this->rawJwtToken = $tokenStorageInterface;
      $this->decodedJwtToken = $this->jwtManager->decode($this->rawJwtToken->getToken());
    }

    public function luckyNumber(Request $request): JsonResponse {
      $number = random_int(0, 100);
      $data = [
        'status' => 200,
        'success' => sprintf('Lucky number is %d', $number),
      ];
      return new JsonResponse($this->decodedJwtToken['username'], 200, $headers = []);
      // return $this->respondAsSuccess($request);
    }


  }

?>
