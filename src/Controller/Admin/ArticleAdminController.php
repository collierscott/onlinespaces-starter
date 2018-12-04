<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\ArticleFormType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/admin/article/new", name="admin_article_new", methods={"GET", "POST"})
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function new(EntityManagerInterface $manager, Request $request)
    {
        $form = $this->createForm(ArticleFormType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var Article $article */
            $article = $form->getData();

            $manager->persist($article);
            $manager->flush();

            $this->addFlash('success', 'A new article has been created.');

            return $this->redirectToRoute('admin_article_list');
        }

        return $this->render('admin/article/new.html.twig', [
            'articleForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/article", name="admin_article_list", methods={"GET"})
     * @return Response
     */
    public function list()
    {
        return $this->render('admin/article/list.html.twig');
    }

}