<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TaskController extends AbstractController
{
    #[Route('/project/{id}/task/create', name: 'task_create')]
    public function create(): Response
    {
        return $this->render('task/create.html.twig', [

        ]);
    }
}
