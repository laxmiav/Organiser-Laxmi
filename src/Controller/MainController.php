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

  
     
    
   






}

