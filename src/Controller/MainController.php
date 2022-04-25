<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
   

    /**
     * @Route("/list", name="app_list")
     */
    public function list(): Response
    {
        return $this->render('main/list.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/main", name="app_main", methods={"GET"})
     */
    public function index(TaskRepository $taskRepository,CategoryRepository $categoryRepository): Response
    {

        return $this->render('main/index.html.twig', [
            'tasks' => $taskRepository->findAllByprocess('TODO'),
            'doing' => $taskRepository->findAllByprocess('Doing'),
            'done' => $taskRepository->findAllByprocess('Done'),
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    
    /**
     * @Route("/main/task/category/{id}", name="app_categoryById", methods={"GET"})
     */
    public function catagoryList(int $id,TaskRepository $taskRepository,CategoryRepository $categoryRepository): Response
    {

        return $this->render('main/category.html.twig', [
            'tasks' => $taskRepository->findAllByCategory('TODO',$id),
            'doing' => $taskRepository->findAllByCategory('Doing',$id),
            'done' => $taskRepository->findAllByCategory('Done',$id),
            'categories' => $categoryRepository->findAll(),
        ]);
    }
     
    
    /**
     * @Route("/main/task/priority", name="app_priority", methods={"GET"})
     */
    public function priorityList(string $priority,TaskRepository $taskRepository,CategoryRepository $categoryRepository): Response
    {

        return $this->render('main/category.html.twig', [
            'tasks' => $taskRepository->findAllByPriority('TODO',$priority),
            'doing' => $taskRepository->findAllByPriority('Doing', $priority),
            'done' => $taskRepository->findAllByPriority('Done',$priority),
            'categories' => $categoryRepository->findAll(),
        ]);
    }
}

