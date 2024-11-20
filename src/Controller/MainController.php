<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'myrig_index')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [

        ]);
    }

    #[Route('/users', name: 'myrig_users')]
    public function users(UserRepository $userRepository): Response
    {
        $userList = $userRepository->findAll();

        return $this->render('main/users.html.twig', [
            'users' => $userList,
        ]);
    }
}
