<?php

namespace App\Controller;

use App\Repository\InstrumentRepository;
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
        $userList = $userRepository->findBy([], ['username' => 'ASC']);

        return $this->render('main/users.html.twig', [
            'users' => $userList,
        ]);
    }

    #[Route('/rig', name: 'myrig_rig')]
    public function rig(UserRepository $userRepository, InstrumentRepository $instrumentRepository): Response
    {
        return $this->render('main/rig.html.twig', [
            'rig' => $userRepository->findOneBy(['id' => $this->getUser()->getId()])->getInstruments(),
            'instruments' => $instrumentRepository->findAll(),
        ]);
    }
}
