<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Doctrine\DBAL\Driver\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/project', name: 'project')]
class ProjectController extends AbstractController
{
    private $projectRepository;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/create', name: 'projectCreate', methods: "POST")]
    public function create(Request $request):Response
    {
        $content = json_decode($request->getContent());

        $projectContent = new Project();

        $projectContent-> setName($content->Name);
        $projectContent-> setMonday($content->Monday);
        $projectContent-> setTuesday($content->Tuesday);
        $projectContent-> setWednesday($content->Wednesday);
        $projectContent-> setThursday($content->Thursday);
        $projectContent-> setFriday($content->Friday);
        $projectContent-> setSunday($content->Sunday);
        $projectContent-> setSaturday($content->Saturday);
        $projectContent-> setDescription($content->Description);

        try {
            $this->entityManager->persist($projectContent);
            $this->entityManager->flush();
        } catch (Exception $exception) {
            return $this->json([
                "message" => ["text" => ["Что-то пошло не так:(!!!"],"level" => "error"]
            ]);
        }
        return $this->json([
            "projectEmployee" => $projectContent->toArray(),
            "message" => ["text" => ["Проект добавлен!!!"],"level" => "success"]
        ]);
    }

    #[Route('/read', name: 'projectRead', methods: "GET")]
    public function index(): Response
    {
        $project = $this->projectRepository->findAll();
        $arrayContainer = [];
        foreach ($project as $item) {
            $arrayContainer[] = $item->toArray();
        }
        return $this -> json($arrayContainer);
    }

    #[Route('/delete/{id}', name: 'projectDelele', methods: "DELETE")]
    public function delete(Project $project) : Response
    {
        try {
            $this->entityManager->remove($project);
            $this->entityManager->flush();
        } catch (Exception $exception) {
            //error
        }

        return $this->json([
            "message" => "Проект удалён!!!"
        ]);
    }
}
