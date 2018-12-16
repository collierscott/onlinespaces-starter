<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends PageController
{
    /**
     * @Route("/", name="home_page")
     * @param ArticleRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ArticleRepository $repository)
    {
        //$this->addFlash('error', 'Testing');
        $context['settings'] = $this->settings;
        $context['content'] = $repository->findAll();
        return $this->render('home/index.html.twig', [
            'context' => $context,
        ]);
    }
}
