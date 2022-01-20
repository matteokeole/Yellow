<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InterfaceCustomerController extends AbstractController
{
    /**
     * @Route("/interface/customer", name="interface_customer")
     */
    public function index(): Response
    {
        return $this->render('interface_customer/index.html.twig', [
            'controller_name' => 'InterfaceCustomerController',
        ]);
    }
}
