<?php

namespace App\Controller;

use App\Entity\Awards;
use App\Form\AwardsType;
use App\Repository\AwardsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/awards')]
final class AwardsController extends AbstractController
{
    #[Route(name: 'app_awards_index', methods: ['GET'])]
    public function index(AwardsRepository $awardsRepository): Response
    {
        return $this->render('awards/index.html.twig', [
            'awards' => $awardsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_awards_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $award = new Awards();
        $form = $this->createForm(AwardsType::class, $award);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($award);
            $entityManager->flush();

            return $this->redirectToRoute('app_awards_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('awards/new.html.twig', [
            'award' => $award,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_awards_show', methods: ['GET'])]
    public function show(Awards $award): Response
    {
        return $this->render('awards/show.html.twig', [
            'award' => $award,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_awards_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Awards $award, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AwardsType::class, $award);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_awards_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('awards/edit.html.twig', [
            'award' => $award,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_awards_delete', methods: ['POST'])]
    public function delete(Request $request, Awards $award, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$award->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($award);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_awards_index', [], Response::HTTP_SEE_OTHER);
    }
}
