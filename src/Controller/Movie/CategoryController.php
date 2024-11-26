<?php

declare(strict_types=1);

namespace App\Controller\Other;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route(path: '/category/{id}', name: 'page_category')]
    public function category(
        Category $category
    ): Response {
        return $this->render('movie/category.html.twig', [
            'category' => $category
        ]);
    }

    #[Route(path: '/discover', name: 'page_discover')]
    public function discover(
        EntityManagerInterface $entityManager,
        CategoryRepository $categoryRepository
    ): Response {
        $categories =  $categoryRepository->findAll();

        return $this->render('movie/discover.html.twig', [
            'categories' => $categories
        ]);
    }
}