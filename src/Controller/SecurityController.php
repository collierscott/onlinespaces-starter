<?php

namespace App\Controller;

use App\Email\Mailer;
use App\Form\UserRegistrationFormType;
use App\Security\UserConfirmationService;
use App\Exception\InvalidConfirmationTokenException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends PageController
{
    /**
     * @Route("/login", name="form_login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig',
            ['last_username' => $lastUsername,
            'error' => $error]);
    }

    /**
     * @Route("/register", name="form_register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param Mailer $mailer
     * @return Response|null
     * @throws \Exception
     */
    public function register(Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        Mailer $mailer
    )
    {
        $form = $this->createForm(UserRegistrationFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                $form['plainPassword']->getData()
            ));

            if (true === $form['agreeTerms']->getData()) {
                $user->agreeToTerms();
            }

            $user->setConfirmationToken(
                bin2hex(random_bytes(40))
            );

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $mailer->sendConfirmationEmail($user);

            return $this->redirectToRoute('please_confirm_email');
        }
        return $this->render('security/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/confirm-email/{token}", name="confirm_user_token")
     * @param string $token
     * @param UserConfirmationService $service
     * @return RedirectResponse
     * @throws InvalidConfirmationTokenException
     */
    public function confirmUser(string $token, UserConfirmationService $service) {
        $service->confirmUser($token);
        $this->addFlash(
            'info',
            'Your email address has been confirmed. Please login.'
        );
        return $this->redirectToRoute('form_login');
    }

    /**
     * @Route("/please-confirm-email" , name="please_confirm_email")
     */
    public function confirm()
    {
        $context['settings'] = $this->settings;
        return $this->render('security/confirm.html.twig', [
            'context' => $context,
        ]);
    }

    /**
     * @Route("/logout", name="form_logout")
     */
    public function logout() {
        // This will never be called
    }
}
