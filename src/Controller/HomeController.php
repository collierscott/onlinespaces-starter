<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class HomeController extends PageController
{
    /**
     * @Route("/", name="home_page")
     */
    public function index()
    {
        $this->addFlash('error', 'Testing');

        $context['settings'] = $this->settings;
        return $this->render('home/index.html.twig', [
            'context' => $context,
        ]);
    }
}
