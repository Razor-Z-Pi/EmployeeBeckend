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
        $this->entityManager = $entityManager;
        $this->loginRepository = $loginRepository;
    }

    #[Route('/Register', name: 'Register_sec', methods: "POST")]
    public function Register(Request $request): Response
    {
        $data = json_decode($request->getContent());
        $login = new Login();

        $login->setName($data->Name);
        $login->setPassword($data->Password);
        $login->setRole($data->Role);
        $login->setIdEmployee($data->Role);

        try {
            $this->entityManager->persist($login);
            $this->entityManager->flush();
        } catch (Exception $exception) {
            return $this->json([
                "message" => ["text" => ["Что-то пошло не так:("], "level" => "error"],
            ]);
        }
        return $this->json([
            "message" => "good",
        ]);
    }

    #[Route('/login', name: 'authorization_sec', methods: "POST")]
    public function Login(Request $request): Response
    {
        try {
            $dataUser = json_decode($request->getContent());
            $dataDB = $this->loginRepository->findAll();
            $array = [];
            $login = false;
            $password = false;
            $role = 0;

            foreach ($dataDB as $item) {
                $array[] = $item->toArray();
            }

            foreach ($array as $value) {
                if ($value["Name"] == $dataUser->login) {
                    $login = true;
                    if ($value["Password"] == $dataUser->Password) {
                        $password = true;
                        $role = $value["Role"];
                    }
                }
            }

            if ($login && $password) {
                return $this->json([
                    "Role" => $role,
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
