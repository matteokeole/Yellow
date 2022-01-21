<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\Order;
use App\Form\OrderFormType;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminOrderController extends AbstractController
{
    //Affichage des commandes de la BDD
    /**
     * @Route("/admin/gestion-des-commandes", name="manageOrder")
     */
    public function manageOrder(OrderRepository $orderRepository): Response
    {
        return $this->render('account/manageOrder/order.html.twig', [
            'orders' => $orderRepository->findAll(),
        ]);
    }

    //Ajouter un produit
    /**
     * @Route("/admin/gestion-des-commandes/nouveau-produit", name="manageorderNew")
     */
    public function neworder(Request $request, EntityManagerInterface $entityManager): Response
    {
        $order = new order();
        $form = $this->createForm(orderFormType::class, $order);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($order);
            $entityManager->flush();
            return $this->redirectToRoute("manageorder");
        }
        return $this->render("account/manageorder/orderNew&Update.html.twig",[
            "order" => $order,
            "form_order" => $form->createView()
        ]);
    }

    //Afficher la fiche d'un produit
    /**
     * @Route("/admin/gestion-des-commandes/{id}", name="manageorderId")
     */
    public function manageorderId(order $order, orderRepository $orderRepository): Response
    {
        return $this->render('account/manageorder/orderId.html.twig', [
            'order' => $order,
        ]);
    }

    //Mise à jour d'une fiche produit
    /**
     * @Route("/admin/gestion-des-commandes/modifier-produit/{id}", name="manageorderUpdate")
     */
    public function updateorder(order $order, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(orderFormType::class, $order);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($order);
            $entityManager->flush();

            return $this->redirectToRoute('manageorder');
        }

        return $this->render('account/manageProduct/productNew&Update.html.twig', [
            'product' => $product,
            'form_Product' => $form->createView(),
        ]);
    }
}
