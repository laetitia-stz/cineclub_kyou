<?php

namespace App\Controller;

use App\Entity\Casting;
use App\Form\CastingType;
use App\Repository\CastingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/casting')]
final class CastingController extends AbstractController
{
    #[Route(name: 'app_casting_index', methods: ['GET'])]
    public function index(CastingRepository $castingRepository): Response
    {
        return $this->render('casting/index.html.twig', [
            'castings' => $castingRepository->findAll(),
        ]);
    }

    #[Route('/actors', name: 'app_casting_actors', methods: ['GET'])]
    public function showActors(CastingRepository $castingRepository): Response
    {
        $actors = $castingRepository->findBy(['role' => 'acteur']);
        return $this->render('casting/actors.html.twig', [
            'actors' => $actors,
        ]);
    }

    #[Route('/directors', name: 'app_casting_directors', methods: ['GET'])]
    public function showDirectors(CastingRepository $castingRepository): Response
    {
        $directors = $castingRepository->findBy(['role' => 'réalisateur']);
        return $this->render('casting/directors.html.twig', [
            'directors' => $directors,
        ]);
    }

    #[Route('/composers', name: 'app_casting_composers', methods: ['GET'])]
    public function showComposers(CastingRepository $castingRepository): Response
    {
        $composers = $castingRepository->findBy(['role' => 'compositeur']);
        return $this->render('casting/composers.html.twig', [
            'composers' => $composers,
        ]);
    }

    #[Route('/new', name: 'app_casting_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $casting = new Casting();
        $form = $this->createForm(CastingType::class, $casting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($casting);
            $entityManager->flush();

            return $this->redirectToRoute('app_casting_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('casting/new.html.twig', [
            'casting' => $casting,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_casting_show', methods: ['GET'])]
    public function show(Casting $casting): Response
    {
        return $this->render('casting/show.html.twig', [
            'casting' => $casting,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_casting_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Casting $casting, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CastingType::class, $casting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_casting_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('casting/edit.html.twig', [
            'casting' => $casting,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_casting_delete', methods: ['POST'])]
    public function delete(Request $request, Casting $casting, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $casting->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($casting);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_casting_index', [], Response::HTTP_SEE_OTHER);
    }
}
