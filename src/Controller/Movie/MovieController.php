<?php

declare(strict_types=1);

namespace App\Controller\Movie;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MovieController extends AbstractController
{
    #[Route(path: '/movies', name: 'page_movies')]
    public function detail(): Response
    {
        return $this->render(view: 'movie/detail.html.twig');
    }

    #[Route(path: '/movie/{id}', name: 'page_detail_movie')]
    public function detailMovie(): Response
    {
        return $this->render(view: 'movie/detail_movie.html.twig');
    }


    #[Route(path: '/serie/{id}', name: 'page_detail_serie')]
    public function detailSerie(): Response
    {
        return $this->render(view: 'movie/detail_serie.html.twig');
    }
}