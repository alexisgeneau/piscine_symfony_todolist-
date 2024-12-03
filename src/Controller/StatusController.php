<?php

namespace App\Controller;

use App\Entity\Status;
use App\Form\StatusType;
use App\Repository\StatusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StatusController extends AbstractController
{
    #[Route('/status', name: 'status')]
    public function index(StatusRepository $statusRepository): Response
    {
        $status = $statusRepository->findAll();

        return $this->render('status/index.html.twig', [
            'status' => $status,
        ]);
    }

    #[Route('/status/create', name: 'status_create')]
    public function create(Request $request, EntityManagerInterface $entityManager)
    {
        $statusItem = new Status();
        $form = $this->createForm(StatusType::class, $statusItem);

        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $entityManager->persist($statusItem);
            $entityManager->flush();

            return $this->redirectToRoute('status');
        }

        $form_view = $form->createView();

        return $this->render('status/create.html.twig', [
            "form_view" => $form_view
        ]);
    }
}
