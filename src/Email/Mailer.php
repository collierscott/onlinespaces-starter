<?php

namespace App\Email;

use App\Entity\User;
use App\Helper\LoggerTrait;

class Mailer
{
    use LoggerTrait;
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    public function __construct(
        \Swift_Mailer $mailer,
        \Twig_Environment $twig
    )
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function sendConfirmationEmail(User $user)
    {
        $body = '';

        try {
            $this->logger->debug($user);
            $body = $this->twig->render('email/confirmation.html.twig', [
                'user' => $user
            ]);
            $this->logger->error($body);
        } catch (\Twig_Error_Loader $e) {
            $this->logger->error($e);
        } catch (\Twig_Error_Runtime $e) {
            $this->logger->error($e);
        } catch (\Twig_Error_Syntax $e) {
            $this->logger->error($e);
        }

        // Send email here
        $message = (new \Swift_Message('Please confirm your account'))
            ->setFrom('api-platform@gmail.com')
            ->setTo($user->getEmail())
            ->setBody($body, 'text/html');
        $this->mailer->send($message);
    }
}