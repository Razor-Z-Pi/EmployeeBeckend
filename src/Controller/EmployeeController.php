<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/employee', name: 'api_employee')]
class EmployeeController extends AbstractController
{
  
  private $employeeRepository;
  private $entityManager;
  
  public function __construct(EntityManagerInterface $entityManager, EmployeeRepository $employeeRepository)
  {
    $this->employeeRepository = $employeeRepository;
    $this->entityManager = $entityManager;
  }
  
  //CRUD
  
  #[Route('/create', name: 'api_employee_create', methods: "POST")]
  public function create(Request $request): Response
  {
    $content = json_decode($request->getContent());
    
    $employee = new Employee();
    
    $employee->setFname($content->fname);
    $employee->setLname($content->lname);
    $employee->setPosition($content->position);
    
    try {
      $this->entityManager->persist($employee);
      $this->entityManager->flush();
    } catch (Exception $exception) {
      return $this->json([
        "message" => ["text" => ["Что-то пошло не так:("], "level" => "error"],
      ]);
    }
    return $this->json([
      "employee" => $employee->toArray(),
      "message" => ["text" => ["Сотрудник был создан!!!", "Сотрудник: " . $content -> fname, $content -> lname, $content -> position], "level" => "success"],
    ]);
  }
  
  
  #[Route('/read', name: 'api_employee_read', methods: "GET")]
  public function index(): Response
  {
    $employee = $this->employeeRepository->findAll();
    $arrayDataEmployee = [];
    foreach ($employee as $item) {
      $arrayDataEmployee[] = $item->toArray();
    }
    
    return $this->json($arrayDataEmployee);
  }
  
  
  #[Route('/update/{id}', name: 'api_employee_update', methods: "PUT")]
  public function update(Request $request, Employee $employee): Response
  {
    $content = json_decode($request->getContent());
    
    $employee->setFname($content->fname);
    $employee->setLname($content->lname);
    $employee->setPosition($content->position);
    
    try {
      $this->entityManager->flush();
    } catch (Exception $exception) {
      //error
    }
    
    return $this->json([
      "message" => "Сотрудник был обновлён",
    ]);
    
  }
  
  
  #[Route('/delete/{id}', name: 'api_employee_delete', methods: "DELETE")]
  public function delete(Employee $employee): Response
  {
    try {
      $this->entityManager->remove($employee);
      $this->entityManager->flush();
    } catch (Exception $exception) {
        return $this->json([
            "message" => ["text" => ["Что-то пошло не так:("], "level" => "error"],
        ]);
    }
    
    return $this->json([
      "message" => "Сотрудник удалён!!!",
    ]);
  }
}
