<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Entity\Guitar;
use App\Form\BrandType;
use App\Form\GuitarType;
use App\Repository\BrandRepository;
use App\Repository\InstrumentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function rig(UserRepository $userRepository, InstrumentRepository $instrumentRepository, BrandRepository $brandRepository, Request $request): Response
    {

        return $this->render('main/rig.html.twig', [
            'rig' => $userRepository->findOneBy(['id' => $this->getUser()->getId()])->getInstruments(),
            'instruments' => $instrumentRepository->findAll(),
            'brands' => $brandRepository->findAll(),
        ]);
    }

    #[Route('/add_brand', name: 'myrig_add_brand', methods: ['POST'])]
    public function addBrand(Request $request, BrandRepository $brandRepository, EntityManagerInterface $entityManager): Response
    {
        $brand = new Brand();
        $brand->setName($request->request->get('name'));
        $date = new \DateTimeImmutable($request->request->get('date'));
        $brand->setCreatedAt($date);
        $brand->setHistory($request->get('history'));
        $entityManager->persist($brand);
        $entityManager->flush();
        return $this->redirectToRoute('myrig_rig');
    }
}
