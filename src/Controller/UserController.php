<?php

namespace App\Controller;

use App\Entity\AvatarImage;
use App\Entity\User;
use App\Form\UserType;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

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
            $user->getId() !== $this->getUser()->getId()
        ) {
            return $this->redirectToRoute('home_page');
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $user = $form->getData();

            $plainPassword = $form['plainPassword']->getData();
            $originalPassword = $form['originalPassword']->getData();

            if(empty($originalPassword) || !$passwordEncoder->isPasswordValid($user, $originalPassword)) {
                $this->addFlash('error', 'You must enter your current password to update your profile.');
                return $this->render('user/index.html.twig', [
                    'form' => $form->createView(),
                ]);
            } else {
                if(!empty($plainPassword)) {
                    $user->setPassword($passwordEncoder->encodePassword(
                        $user,
                        $plainPassword
                    ));
                }
            }

            $em = $this->getDoctrine()->getManager();

            /** @var AvatarImage $avatar */
            $avatar = $form['avatar']->getData();
            $file = $avatar->getFile();

            if($file) {
                $avatar->setId(Uuid::uuid4());
                $avatar->setUrl($file->getFilename());
                //dd($avatar);
                $em->persist($avatar);
                $em->flush();
                $user->setAvatar($avatar);
            } else {
                $user->setAvatar(null);
                $em->remove($avatar);
                $avatar = null;
            }

            // dd($avatar);
            $user->setUpdatedAt(new \DateTime("now"));

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
