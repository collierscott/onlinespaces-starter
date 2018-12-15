<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminSettingsController extends AbstractController
{
    /**
     * @Route("/admin/settings", name="admin_settings")
     */
    public function settings()
    {
        return $this->render('admin/settings.html.twig', [
            'controller_name' => 'AdminSettingsController',
        ]);
    }

    /**
     * @Route("/admin/site-settings", name="admin_site_settings")
     */
    public function index()
    {
        return $this->render('admin/site_settings.html.twig', [
            'controller_name' => 'AdminSettingsController',
        ]);
    }
}
