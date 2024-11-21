<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserEditType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class UserController extends AbstractController
{
    #[Route(path: '/register', name: 'myrig_register')]
    public function register(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher,EntityManagerInterface $entityManager, EventDispatcherInterface $eventDispatcher): Response
    {
        $registrationForm = $this->createForm(UserType::class);
        $registrationForm->handleRequest($request);

        if($registrationForm->isSubmitted() && $registrationForm->isValid()) {
            $alreadyExisting = $userRepository->findOneBy(['username' => $registrationForm->get('username')->getData()]);
            if($alreadyExisting) {
                $this->addFlash('error', 'Username already exists.');
                return $this->redirectToRoute('myrig_register');
            }
            $user = new User();
            $user->setRoles(['ROLE_USER']);
            $user->setUsername($registrationForm->get('username')->getData());
            $hash = $passwordHasher->hashPassword($user, $registrationForm->get('password')->getData());
            $user->setPassword($hash);
            $user->setAge($registrationForm->get('age')->getData());
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'You are now successfully registered!');
            $providerKey = 'main';
            $token = new UsernamePasswordToken($user, 'main', $user->getRoles());
            $this->container->get('security.token_storage')->setToken($token);
            return $this->redirectToRoute('myrig_index');
        }

        return $this->render('user/register.html.twig', [
            'registrationForm' => $registrationForm->createView(),
        ]);
    }

    #[Route(path: '/account', name: 'myrig_account')]
    public function account(UserRepository $userRepository)
    {
        $user = $userRepository->findOneBy(['username' => $this->getUser()->getUsername()]);
        $accountForm = $this->createForm(UserEditType::class, $user);

        return $this->render('user/account.html.twig', [
            'accountForm' => $accountForm->createView(),
        ]);
    }
}
