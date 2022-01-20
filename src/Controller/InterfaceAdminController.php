<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InterfaceAdminController extends AbstractController
{
    /**
     * @Route("/admin", name="interface_admin")
     */
    public function index(): Response
    {
        return $this->render('interface_admin/index.html.twig', [
            'controller_name' => 'InterfaceAdminController',
        ]);
    }
        /**
     * @Route("/admin/gestion-des-produits", name="manageProduct")
     */
    public function manageProduct(): Response
    {
        return $this->render('interface_admin/manage_product.html.twig');
    }
    /**
     * @Route("/admin/gestion-des-clients", name="manageCustomer")
     */
    public function manageCustomer(): Response
    {
        return $this->render('interface_admin/manage_customer.html.twig');
    }
    /**
     * @Route("/admin/gestion-des-commandes", name="manageOrder")
     */
    public function manageOrder(): Response
    {
        return $this->render('interface_admin/manage_order.html.twig');
    }

}
