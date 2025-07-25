<?php

namespace App\Controller;

use App\Entity\Horoscope;
use App\Form\HoroscopeType;
use App\Repository\HoroscopeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// #[Route('/horoscope')]
// final class HoroscopeController extends AbstractController
// {
//     #[Route(name: 'app_horoscope_index', methods: ['GET'])]
//     public function index(HoroscopeRepository $horoscopeRepository): Response
//     {
//         return $this->render('horoscope/index.html.twig', [
//             'horoscopes' => $horoscopeRepository->findAll(),
//         ]);
//     }

//     #[Route('/new', name: 'app_horoscope_new', methods: ['GET', 'POST'])]
//     public function new(Request $request, EntityManagerInterface $entityManager): Response
//     {
//         $horoscope = new Horoscope();
//         $form = $this->createForm(HoroscopeType::class, $horoscope);
//         $form->handleRequest($request);

//         if ($form->isSubmitted() && $form->isValid()) {
//             $entityManager->persist($horoscope);
//             $entityManager->flush();

//             return $this->redirectToRoute('app_horoscope_index', [], Response::HTTP_SEE_OTHER);
//         }

//         return $this->render('horoscope/new.html.twig', [
//             'horoscope' => $horoscope,
//             'form' => $form,
//         ]);
//     }

//     #[Route('/{id}', name: 'app_horoscope_show', methods: ['GET'])]
//     public function show(Horoscope $horoscope): Response
//     {
//         return $this->render('horoscope/show.html.twig', [
//             'horoscope' => $horoscope,
//         ]);
//     }

//     #[Route('/{id}/edit', name: 'app_horoscope_edit', methods: ['GET', 'POST'])]
//     public function edit(Request $request, Horoscope $horoscope, EntityManagerInterface $entityManager): Response
//     {
//         $form = $this->createForm(HoroscopeType::class, $horoscope);
//         $form->handleRequest($request);

//         if ($form->isSubmitted() && $form->isValid()) {
//             $entityManager->flush();

//             return $this->redirectToRoute('app_horoscope_index', [], Response::HTTP_SEE_OTHER);
//         }

//         return $this->render('horoscope/edit.html.twig', [
//             'horoscope' => $horoscope,
//             'form' => $form,
//         ]);
//     }

//     #[Route('/{id}', name: 'app_horoscope_delete', methods: ['POST'])]
//     public function delete(Request $request, Horoscope $horoscope, EntityManagerInterface $entityManager): Response
//     {
//         if ($this->isCsrfTokenValid('delete'.$horoscope->getId(), $request->getPayload()->getString('_token'))) {
//             $entityManager->remove($horoscope);
//             $entityManager->flush();
//         }

//         return $this->redirectToRoute('app_horoscope_index', [], Response::HTTP_SEE_OTHER);
//     }
// }

#[Route('/horoscope/{nom}', name: 'afficher_horoscope')]
public function afficher(string $nom, SigneRepository $signeRepo, HoroscopeRepository $horoscopeRepo): Response
{
    $signe = $signeRepo->findOneBy(['nom' => ucfirst(strtolower($nom))]);

    if (!$signe) {
        throw $this->createNotFoundException("Signe '$nom' introuvable.");
    }

    $aujourdhui = new \DateTimeImmutable();
    $horoscope = $horoscopeRepo->findOneBy([
        'signe' => $signe,
        'dateDuJour' => $aujourdhui
    ]);

    return $this->render('horoscope/afficher.html.twig', [
        'signe' => $signe,
        'horoscope' => $horoscope
    ]);
}

#[Route('/', name: 'homepage')]
public function accueil(): Response
{
    return $this->render('home/index.html.twig');
}
