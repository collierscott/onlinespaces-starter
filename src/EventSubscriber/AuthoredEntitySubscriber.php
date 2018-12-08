<?php

namespace App\EventSubscriber;

use App\Entity\Abstracts\AuthoredEntityInterface;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AuthoredEntitySubscriber implements EventSubscriberInterface
{
    /** @var TokenStorageInterface $tokenStorage */
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return string[]
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => ['getAuthenticatedUser']
        ];
    }

    public function getAuthenticatedUser(GetResponseEvent $event)
    {
        $entity = $event->getResponse();
        $method = $event->getRequest()->getMethod();

        if(!$entity instanceof AuthoredEntityInterface
            || Request::METHOD_POST !== $method) {
            return;
        }

        /** @var User $author */
        $token = $this->tokenStorage->getToken();

        if(null === $token) {
            return;
        }

        $author = $token->getUser();
        dd($author);
        $entity->setAuthor($author);
    }
}