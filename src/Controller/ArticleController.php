<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/articles", name="article_list")
     * @param ArticleRepository $repository
     * @return Response
     */
    public function list(ArticleRepository $repository)
    {
        $articles = $repository->findAll();
        return $this->render('article/list.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/articles/{slug}", name="article_show")
     * @param $slug
     * @param ArticleRepository $repository
     * @return Response
     */
    public function show($slug, ArticleRepository $repository)
    {
        /** @var Article $article */
        $article = $repository->findOneBy(['slug' => $slug]);
        if (!$article) {
            throw $this->createNotFoundException(sprintf('No article for slug "%s"', $slug));
        }
        return $this->render('article/show.html.twig', [
            'article' => $article
        ]);
    }
}