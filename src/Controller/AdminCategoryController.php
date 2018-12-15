<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AdminCategoryController extends AbstractController
{
    /**
     * @Route("/admin/categories", name="admin_categories_list")
     * @param CategoryRepository $repository
     * @return Response
     */
    public function list(CategoryRepository $repository)
    {
        $categories = $repository->findAll();
        $context['content'] = $categories;

        return $this->render('admin/categories/list.html.twig', [
            'context' => $context
        ]);
    }

    /**
     * @Route(path="/admin/categories/new", name="admin_categories_new"), methods={"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(CategoryType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();
            $em->persist($category);
            $em->flush();
            $this->addFlash('success', 'The category was successfully completed.');
            return $this->redirectToRoute('admin_categories_list');
        }

        return $this->render('admin/categories/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route(path="/admin/categories/{id}/edit", name="admin_categories_edit", methods={"GET", "POST"})
     *
     * @param Category $category
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function edit(Category $category, Request $request, EntityManagerInterface $em)
    {
        if(!$category) {
            $this->addFlash('danger', 'The category does not exist.');
            return $this->redirectToRoute('admin_categories_list');
        }

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'The category has been updated.');
            return $this->redirectToRoute('admin_categories_list');
        }

        return $this->render('admin/categories/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route(path="/admin/categories/{id}/delete", name="admin_categories_delete", methods={"GET", "DELETE"})
     *
     * @param Category $category
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse
     */
    public function delete(Category $category, Request $request, EntityManagerInterface $em)
    {
        $em->remove($category);
        $em->flush();
        $this->addFlash('success', 'The category has been deleted.');
        return $this->redirectToRoute('admin_categories_list');
    }
}
