<?php

namespace App\Controller;

use App\Entity\Login;
use App\Repository\LoginRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Config\Doctrine\Orm\EntityManagerConfig;

#[Route('/auth', name: 'authorization')]
class AuthorizationController extends AbstractController
{
    private $entityManager;
    private $loginRepository;
    
    public function __construct(EntityManagerInterface $entityManager, LoginRepository $loginRepository)
    {
      $this -> entityManager = $entityManager;
      $this -> loginRepository = $loginRepository;
    }
  
  #[Route('/login', name: 'authorization_sec', methods: "POST")]
    public function Login(Request $request) : Response
  {
    $dataUser = json_decode($request -> getContent());
    $dataDB = $this -> loginRepository -> findAll();
    
//    $Login = new Login();
//
//    $nameData = $Login -> getName();
//    $passwordData = $Login -> getPassword();
  
    try {
      if (($dataUser -> login == "admin") && ($dataUser -> Password == "123456")) {
        return $this->json([
          "message" => ["level" => "good"],
        ]);
      } else {
        return $this->json([
          "message" => ["level" => "block"],
        ]);
      }
    } catch (Exception $exception) {
      return $this->json([
        "message" => ["level" => "error"],
      ]);
    }
  }
}
