<?php

namespace App\Controller;

use App\Entity\Config\SiteSettings;
use App\Form\SettingsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AdminSettingsController extends AbstractController
{
    /**
     * @Route("/admin/settings", name="admin_settings")
     */
    public function settings()
    {
        return $this->render('admin/settings/settings.html.twig', [
            'controller_name' => 'AdminSettingsController',
        ]);
    }

    /**
     * @Route("/admin/site-settings", name="admin_site_settings", methods={"GET", "POST"})
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     */
    public function siteSettings(EntityManagerInterface $em, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        /** @var SiteSettings $page */
        $settings = $em->getRepository('App\Entity\Config\SiteSettings')
            ->findAll();

        if(!$settings) {
            $settings = new SiteSettings();
        } else {
            $settings = $settings[0];
        }

        $form = $this->createForm(SettingsType::class, $settings);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $settings = $form->getData();
            $em->persist($settings);
            $em->flush();
            $this->addFlash('success','Settings have been updated.');
        }

        return $this->render('admin/settings/site_settings.html.twig', [
            'controller_name' => 'AdminSettingsController',
            'form' => $form->createView(),
        ]);
    }
}
