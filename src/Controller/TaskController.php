<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TaskController extends AbstractController
{
    #[Route('/project/{id}/task/create', name: 'task_create')]
    public function create(int $id, Request $request, EntityManagerInterface $entityManager, ProjectRepository $projectRepository): Response
    {
        $task = new Task();
        $task_form = $this->createForm(TaskType::class, $task);

        $task_form->handleRequest($request);

        if ($task_form->isSubmitted()) {
            $project = $projectRepository->find($id);

            if (!$project) {
                return $this->redirectToRoute('not_found');
            }

            $task->setProject($project);
            $task->setCreatedAt(new \DateTimeImmutable());

            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('project_update', ['id' => $project->getId()]);
        }

        return $this->redirectToRoute('not_found');
    }
}
