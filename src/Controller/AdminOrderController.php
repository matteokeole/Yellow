<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\Order;
use App\Entity\Basket;
use App\Form\OrderFormType;
use App\Repository\CustomerRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repositoy\BasketRepository;
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
            'orders' => $orderRepository->findAllCustomer(), 
        ]);
    }

    // /**
    //  * @Route("/admin/gestion-des-commandes/{id}", name="manageOrderId")
    //  */
    // public function manageOrder(Order $order, CustomerRepository $customerRepository): Response
    // {
    //     return $this->render('account/manageOrder/order.html.twig', [
    //         'order' => $order,
    //         'customers' => $customerRepository->findBy(['order'=>$order]),
    //     ]);
    // }

    // //Afficher la fiche d'une commande
    // /**
    //  * @Route("/admin/gestion-des-commandes/{id}", name="manageorderId")
    //  */
    // public function manageorderId(order $order, orderRepository $orderRepository): Response
    // {
    //     return $this->render('account/manageorder/orderId.html.twig', [
    //         'order' => $order,
    //     ]);
    // }

    // //Mise à jour d'une fiche produit
    // /**
    //  * @Route("/admin/gestion-des-commandes/modifier-produit/{id}", name="manageorderUpdate")
    //  */
    // public function updateorder(order $order, Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $form = $this->createForm(orderFormType::class, $order);
    //     $form->handleRequest($request);
    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->persist($order);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('manageorder');
    //     }

    //     return $this->render('account/manageProduct/productNew&Update.html.twig', [
    //         'product' => $product,
    //         'form_Product' => $form->createView(),
    //     ]);
    // }
}
