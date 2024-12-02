<?php

namespace App\Controller;

use App\Repository\MoviesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(MoviesRepository $moviesRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'lastMovies' => $moviesRepository->getLastInserted(5)
        ]);
    }
}
