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
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
