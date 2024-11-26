<?php

declare(strict_types=1);

namespace App\Controller\Other;

use App\Repository\SubscriptionRepository;
use App\Entity\Subscription;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SubscriptionController extends AbstractController
{
    #[Route(path: '/subscription/{id}', name: 'page_sub')]
    public function category(
        Subscription $subscription
    ): Response {
        return $this->render('movie/abonnements.html.twig', [
            'subscription' => $subscription
        ]);
    }

    #[Route('/subscriptions', name: 'page_all_subscriptions')]
    public function subscriptions(
        EntityManagerInterface $entityManager,
        SubscriptionRepository $subscriptionRepository
    ): Response {
        $subscriptions =  $subscriptionRepository->findAll();

        return $this->render('card_subscription.html.twig', [
            'subscriptions' => $subscriptions
        ]);
    }
}
