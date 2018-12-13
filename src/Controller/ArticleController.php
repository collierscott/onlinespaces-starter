<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends PageController
{
    /**
     * @Route("/articles", name="article_list")
     * @param ArticleRepository $repository
     * @return Response
     */
    public function list(ArticleRepository $repository)
    {
        $content = $repository->findAll();
        $context['content'] = $content;
        $context['settings'] = $this->settings;

        return $this->render('article/list.html.twig', [
            'context' => $context,
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

        $context['content'] = $article;
        $context['page'] = $this->page;

        return $this->render('article/show.html.twig', [
            'context' => $context,
        ]);
    }
}