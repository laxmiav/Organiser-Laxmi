<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    // // /**
    // //  * @Route("/main", name="app_main")
    // //  */
    // public function index(): Response
    // {
    //     return $this->render('main/index.html.twig', [
    //         'controller_name' => 'MainController',
    //     ]);
    // }
     /**
     * @Route("/list", name="app_list")
     */
    public function list(): Response
    {
        return $this->render('main/list.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}

