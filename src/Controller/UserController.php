<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/user/profile/{id}", name="user_profile", requirements={"id"="\d+"})
     * @param Request $request
     * @param User $user
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function profile(Request $request, User $user, UserPasswordEncoderInterface $passwordEncoder)
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

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Your profile has been updated.');

            return $this->render('user/index.html.twig', [
                'form' => $form->createView(),
            ]);
        }

        return $this->render('user/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
