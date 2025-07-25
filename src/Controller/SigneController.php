<?php

namespace App\Controller;

use App\Entity\Signe;
use App\Form\SigneType;
use App\Repository\SigneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/signe')]
final class SigneController extends AbstractController
{
    #[Route(name: 'app_signe_index', methods: ['GET'])]
    public function index(SigneRepository $signeRepository): Response
    {
        return $this->render('signe/index.html.twig', [
            'signes' => $signeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_signe_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $signe = new Signe();
        $form = $this->createForm(SigneType::class, $signe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($signe);
            $entityManager->flush();

            return $this->redirectToRoute('app_signe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('signe/new.html.twig', [
            'signe' => $signe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_signe_show', methods: ['GET'])]
    public function show(Signe $signe): Response
    {
        return $this->render('signe/show.html.twig', [
            'signe' => $signe,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_signe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Signe $signe, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SigneType::class, $signe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_signe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('signe/edit.html.twig', [
            'signe' => $signe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_signe_delete', methods: ['POST'])]
    public function delete(Request $request, Signe $signe, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$signe->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($signe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_signe_index', [], Response::HTTP_SEE_OTHER);
    }
}
