<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Security\LoginFormAuthenticator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class UserController extends AbstractController
{
    /**
     * @Route("/user/profile/{id}", name="user_profile", requirements={"id"="\d+"})
     * @param Request $request
     * @param User $user
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param GuardAuthenticatorHandler $guardHandler
     * @param LoginFormAuthenticator $formAuthenticator
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function profile(
        Request $request,
        User $user,
        UserPasswordEncoderInterface $passwordEncoder,
        GuardAuthenticatorHandler $guardHandler,
        LoginFormAuthenticator $formAuthenticator
    )
    {
        if(
            !$this->isGranted('IS_AUTHENTICATED_FULLY') ||
            !$user->getId() === $this->getUser()->getId()
        ) {
            return $this->redirectToRoute('home_page');
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            /** @var User $user */
            $user = $form->getData();

            if(!$passwordEncoder->isPasswordValid($user, $form['originalPassword']->getData())) {
                $this->addFlash('error', 'The password you entered is not your current password.');
                return $this->render('user/index.html.twig', [
                    'form' => $form->createView(),
                ]);
            }

            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                $form['plainPassword']->getData()
            ));

            $user->setUpdatedAt(new \DateTime("now"));

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('success', 'Your profile has been updated.');

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $formAuthenticator,
                'main'
            );
        }

        return $this->render('user/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
