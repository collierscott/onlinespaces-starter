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
use Symfony\Component\HttpFoundation\RedirectResponse;

class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/admin/articles/new", name="admin_article_new", methods={"GET", "POST"})
     * @param EntityManagerInterface $manager
     * @param Request $request
     * @return Response
     */
    public function new(EntityManagerInterface $manager, Request $request)
    {
        $form = $this->createForm(ArticleFormType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var Article $article */
            $article = $form->getData();
            $article->setAuthor($this->getUser());

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
     * @Route("/admin/articles", name="admin_article_list", methods={"GET"})
     * @param ArticleRepository $repository
     * @return Response
     */
    public function list(ArticleRepository $repository)
    {
        $articles = $repository->findAll();
        $context['content'] = $articles;

        return $this->render('admin/article/list.html.twig', [
            'context' => $context,
        ]);
    }

    /**
     * @Route("/admin/articles/{id}/edit", name="admin_article_edit", methods={"GET", "POST"})
     * @param Article $article
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function edit(Article $article, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(ArticleFormType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($article);
            $manager->flush();

            $this->addFlash('success', 'Article has been updated.');

            return $this->redirectToRoute('admin_article_edit', [
                'id' => $article->getId(),
            ]);
        }

        return $this->render('admin/article/edit.html.twig', [
            'articleForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/articles/{id}/delete", name="admin_article_delete", methods={"GET"})
     *
     * @param Article $article
     * @param EntityManagerInterface $manager
     * @return RedirectResponse
     */
    public function delete(Article $article, EntityManagerInterface $manager)
    {
        if(!$article) {
            $this->addFlash('error', 'The article does not exist.');
            return $this->redirectToRoute('admin_article_list');
        }
        $manager->remove($article);
        $manager->flush();
        $this->addFlash('success', 'Article has been deleted.');
        return $this->redirectToRoute('admin_article_list');
    }
}