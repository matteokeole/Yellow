<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InterfaceAdminController extends AbstractController
{
    /**
     * @Route("/interface/admin", name="interface_admin")
     */
    public function index(): Response
    {
        return $this->render('interface_admin/index.html.twig', [
            'controller_name' => 'InterfaceAdminController',
        ]);
    }
}
