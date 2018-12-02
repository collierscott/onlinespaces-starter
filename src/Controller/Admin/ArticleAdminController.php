<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/admin/article", name="admin_article_list", methods={"GET"})
     * @return Response
     */
    public function list()
    {
        return new Response('List articles');
    }
    /**
     * @Route("/admin/article/new", name="admin_article_new", methods={"GET", "POST"})
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function new(EntityManagerInterface $manager)
    {
        return new Response('New article');
    }

}