<?php

namespace App\Controller;

use App\Entity\PlaylistSubscription;
use App\Repository\PlaylistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Playlist;
use App\Repository\PlaylistSubscriptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListController extends AbstractController
{
    #[Route('/playlist/{id}', name: 'page_list')]
    public function list(
        Playlist $playlist
    ): Response {
        return $this->render('movie/lists.html.twig', [
            'playlist' => $playlist
        ]);
    }

    #[Route('/playlist', name: 'page_all_list')]
    public function allList(
        EntityManagerInterface $entityManager,
        PlaylistRepository $playlistRepository
    ): Response {
        $playlists =  $playlistRepository->findAll();

        return $this->render('movie/lists.html.twig', [
            'playlists' => $playlists
        ]);
    }

    #[Route('/lists', name: 'page_lists')]
    public function index(
        PlaylistRepository $playlistRepository,
        PlaylistSubscriptionRepository $playlistSubscriptionRepository
    ): Response {
        $playlists = $playlistRepository->findAll();
        $playlistSubscriptions = $playlistSubscriptionRepository->findAll();

        return $this->render('index.html.twig', [
            'playlists' => $playlists,
            'playlistSubscriptions' => $playlistSubscriptions
        ]);
    }
}
