<?php

declare(strict_types=1);

namespace App\Controller\Other;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route(path: '/categories', name: 'page_categories')]
    public function categories()
    {
        return $this->render('other/discover.html.twig');
    }
}
