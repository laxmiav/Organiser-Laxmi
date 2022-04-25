<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\CategoryRepository;
use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TaskController extends AbstractController
{
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
     * @Route("task/category/{id}", name="app_categoryById", methods={"GET"})
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
     * @Route("task/{priority}", name="app_priority", methods={"GET"})
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

   
    /**
     * @Route("task/{id}", name="app_task_show", methods={"GET"})
     */
    public function show(Task $task): Response
    {
        return $this->render('task/show.html.twig', [
            'task' => $task,
        ]);
    }

    /**
     * @Route("task/{id}/edit", name="app_task_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Task $task, TaskRepository $taskRepository): Response
    {
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $taskRepository->add($task);
            return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('task/edit.html.twig', [
            'task' => $task,
            'form' => $form,
        ]);
    }

    /**
     * @Route("task/{id}/delete", name="app_task_delete", methods={"POST"})
     */
    public function delete(Request $request, Task $task, TaskRepository $taskRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$task->getId(), $request->request->get('_token'))) {
            $taskRepository->remove($task);
        }

        return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);
    }




     /**
     * @Route("/task/create", name="app_task_new", methods={"GET", "POST"})
     */
    public function create(Request $request, TaskRepository $taskRepository): Response
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $taskRepository->add($task);
            return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('task/create.html.twig', [
            'task' => $task,
            'form' => $form,
        ]);
    }

}
