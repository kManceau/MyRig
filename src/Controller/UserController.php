<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserEditType;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Service\ImageService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class UserController extends AbstractController
{
    #[Route(path: '/register', name: 'myrig_register')]
    public function register(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher,
                             EntityManagerInterface $entityManager, ImageService $imageService): Response
    {
        $registrationForm = $this->createForm(UserType::class);
        $registrationForm->handleRequest($request);

        if ($registrationForm->isSubmitted() && $registrationForm->isValid()) {
            $alreadyExisting = $userRepository->findOneBy(['username' => $registrationForm->get('username')->getData()]);
            if ($alreadyExisting) {
                $this->addFlash('error', 'Username already exists.');
                return $this->redirectToRoute('myrig_register');
            }
            $user = new User();
            $user->setRoles(['ROLE_USER']);
            $user->setUsername($registrationForm->get('username')->getData());
            $hash = $passwordHasher->hashPassword($user, $registrationForm->get('password')->getData());
            $user->setPassword($hash);
            $user->setAge($registrationForm->get('age')->getData());
            $user->setCatchphrase($registrationForm->get('catchphrase')->getData());
            $entityManager->persist($user);
            $entityManager->flush();
            if ($registrationForm->get('avatar')->getData()) {
                $imageService->uploadImages($registrationForm->get('avatar')->getData(), $user->getId(), 'users');
            }
            $this->addFlash('success', 'You are now successfully registered!');
            $token = new UsernamePasswordToken($user, 'main', $user->getRoles());
            $this->container->get('security.token_storage')->setToken($token);
            return $this->redirectToRoute('myrig_index');
        }

        return $this->render('user/register.html.twig', [
            'registrationForm' => $registrationForm->createView(),
        ]);
    }

    #[Route(path: '/account', name: 'myrig_account')]
    public function account(UserRepository $userRepository, Request $request, ImageService $imageService, EntityManagerInterface $entityManager,)
    {
        $user = $userRepository->findOneBy(['username' => $this->getUser()->getUsername()]);
        $accountForm = $this->createForm(UserEditType::class, $user);
        $accountForm->handleRequest($request);

        if ($accountForm->isSubmitted() && $accountForm->isValid()) {
            $user->setAge($accountForm->get('age')->getData());
            $user->setCatchphrase($accountForm->get('catchphrase')->getData());
            $entityManager->persist($user);
            $entityManager->flush();
            if ($accountForm->get('avatar')->getData()) {
                $imageService->uploadImages($accountForm->get('avatar')->getData(), $user->getId(), 'users');
            }
            $this->addFlash('success', 'Account Succesfully updated!');
            return $this->redirectToRoute('myrig_account');
        }
        return $this->render('user/account.html.twig', [
            'user' => $user,
            'accountForm' => $accountForm->createView(),
        ]);
    }

    #[Route(path: '/delete/{id}', name: 'myrig_delete_account')]
    public function delete($id, UserRepository $userRepository, ImageService $imageService, EntityManagerInterface $entityManager,)
    {
        $user = $userRepository->findOneBy(['username' => $this->getUser()->getUsername()]);
        $entityManager->remove($user);
        $entityManager->flush();
        $imageService->deleteImages($id, 'users');
        $this->addFlash('success', 'Account Succesfully deleted! :(');
        $this->container->get('security.token_storage')->setToken(null);
        return $this->redirectToRoute('myrig_index');
    }
}
