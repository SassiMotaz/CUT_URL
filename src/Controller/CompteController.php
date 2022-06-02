<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\Password;
use App\Entity\PasswordUpdate;
use App\Security\EmailVerifier;
use App\Form\PasswordUpdateType;
use App\Form\RegistrationFormType;
use Symfony\Component\Mime\Address;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CompteController extends AbstractController
{
    #[Route('/compte/profil', name: 'app_profil')]
    public function index(): Response
    {
        return $this->render('compte/profil.html.twig', [
            'controller_name' => 'CompteController',
        ]);
    }
    private $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    #[Route('/compte/edit', name: 'app_edit')]
    public function edit(Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manger = $this->getDoctrine()->getManager();
            $manger->persist($user);
            $manger->flush();

            $this->emailVerifier->sendEmailConfirmation(
                'app_verify_email',
                $user,
                (new TemplatedEmail())
                    ->from(new Address('sassimotaze99@gmail.com', 'ATC Bot'))
                    ->to($user->getEmail())
                    ->subject('Bienvenue chez nous !')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            return $this->redirectToRoute('app_profil');
        }
        return $this->render('compte/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/compte/edit_motdepass', name: 'app_mdpup')]
    public function updatePassword(Request $request, UserPasswordHasherInterface $passwordEncoder)
    {
        $passwordUpdate = new PasswordUpdate();
        $user = $this->getUser();
        $form = $this->createForm(PasswordUpdateType::class, $passwordUpdate);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!password_verify($passwordUpdate->getOldPassword(), $user->getPassword())) {
                $form->get('oldPassword')->addError(new FormError("Le mot de passe que vous avez tapé n'est pas votre mot de passe actuel ! "));
            } else {
                $newPassword = $passwordUpdate->getNewPassword();
                $password = $passwordEncoder->hashPassword($user, $newPassword);
                $user->setPassword($password);
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($user);
                $manager->flush();
            }
            return $this->redirectToRoute('app_logout');
        }
        return $this->render('compte/mdp.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
