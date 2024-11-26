<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MediaRepository;
use App\Repository\MovieRepository;
use App\Repository\SerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route(path: '/', name: 'page_home')]
    public function accueil()
    {
        return $this->render('index.html.twig');
    }

    public function home(
        MediaRepository $mediaRepository,
    ):Response {
        $medias = $mediaRepository->findPopularMedia(max: 9);

        return $this->render('index', [
            'medias' => $medias
        ]);
    }
}

