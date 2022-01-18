<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Controller extends AbstractController
{
    #[Route('/', name: '')]
  
    public function getUsers() {
      $user = [
        [
          "id" => 1,
          "name" => "sadasd"
        ],
        [
          "id" => 2,
          "name" => "sadasadsasdsd"
        ],
        [
          "id" => 3,
          "name" => "fffffsadasd"
        ]
      ];
      
      $response = new Response();
      
      $response -> headers -> set("Content-Type", "application/json");
      $response -> headers -> set("Access-Control-Allow-Origin", "*");
      
      $response -> setContent(json_encode($user));
      
      return $response;
    }
}
