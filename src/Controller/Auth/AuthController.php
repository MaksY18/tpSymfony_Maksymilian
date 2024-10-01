<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthController extends AbstractController
{
    #[Route(path: '/login', name: 'page_login')]
    public function login(): Response
    {
        return $this->render('auth/login.html.twig');
    }

    #[Route(path: '/register', name: 'page_register')]
    public function register(): Response
    {
        return $this->render('auth/register.html.twig');
    }

    #[Route(path: '/forgot', name: 'page_forgot_password')]
    public function forgotPassword(): Response
    {
        return $this->render('auth/forgot.html.twig');
    }

    #[Route(path: '/reset', name: 'page_reset_password')]
    public function resetPassword(): Response
    {
        return $this->render('auth/reset.html.twig');
    }

    #[Route(path: '/confirm', name: 'page_confirm_account')]
    public function confirmAccount(): Response
    {
        return $this->render('auth/confirm.html.twig');
    }
}
