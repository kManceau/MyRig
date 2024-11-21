<?php

namespace App\Controller;

use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'myrig_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
        ]);
    }

    #[Route('/admin/users', name: 'myrig_admin_users')]
    public function adminUsers(UserRepository $userRepository): Response
    {
        return $this->render('admin/users.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/admin/user/{id}', name: 'myrig_admin_user_edit')]
    public function adminUserEdit($id, UserRepository $userRepository, Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = $userRepository->findOneBy(['id' => $id]);
        $userEditForm = $this->createForm(UserType::class, $userRepository->find($id));
        $userEditForm->handleRequest($request);

        if($userEditForm->isSubmitted()) {
            if($userEditForm->get('username')->getData()){
                $user->setUsername($userEditForm->get('username')->getData());
            }
            if($userEditForm->get('password')->getData()) {
                $hash = $passwordHasher->hashPassword($user, $userEditForm->get('password')->getData());
                $user->setPassword($hash);
            }
            if($userEditForm->get('age')->getData()){
                $user->setAge($userEditForm->getData()->getAge());
            }
            if($userEditForm->get('catchphrase')->getData()){
                $user->setCatchphrase($userEditForm->getData()->getCatchphrase());
            }
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Account successfully updated.');
            return $this->redirectToRoute('myrig_admin_users');
        }

        return $this->render('admin/userEdit.html.twig', [
            'user' => $user,
            'userEditForm' => $userEditForm->createView(),
        ]);
    }
}
