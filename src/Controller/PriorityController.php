<?php
namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;




class PriorityController extends AbstractController
{


 /**
     * @Route("/priority/{priority}", name="app_priority", methods={"GET"})
     */
    public function priorityList(string $priority,TaskRepository $taskRepository,CategoryRepository $categoryRepository): Response
    {

        return $this->render('main/index.html.twig', [
            'tasks' => $taskRepository->findAllByPriority('TODO',$priority),
            'doing' => $taskRepository->findAllByPriority('Doing', $priority),
            'done' => $taskRepository->findAllByPriority('Done',$priority),
            'categories' => $categoryRepository->findAll(),
            
        ]);
    }

/**
     * @Route("/priority/{priority}/category/{priorityid}", name="priorityByCategory", methods={"GET"})
     */
    public function priorityByCategory(int $priorityid,string $priority,TaskRepository $taskRepository,CategoryRepository $categoryRepository): Response
    {

        return $this->render('main/category.html.twig', [
            'tasks' => $taskRepository->findAllByPriorityNCategory('TODO',$priorityid,$priority),
            'doing' => $taskRepository->findAllByPriorityNCategory('Doing',$priorityid,$priority,),
            'done' => $taskRepository->findAllByPriorityNCategory('Done',$priorityid,$priority,),
            'categories' => $categoryRepository->findAll(),
            'mycategory' => $categoryRepository->find($priorityid),
        ]);
    }




























}