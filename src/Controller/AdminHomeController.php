<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminHomeController extends AbstractController
{

    /**
     * @Route(path="/admin", name="admin_home")
     */
    public function index()
    {
        return $this->render('admin/home.html.twig');
    }
}