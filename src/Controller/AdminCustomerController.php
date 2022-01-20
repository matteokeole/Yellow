<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerFormType;
use App\Form\SignupFormType;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCustomerController extends AbstractController
{
    //Affichage des clients de la BDD
    /**
     * @Route("/admin/gestion-des-clients", name="manageCustomer")
     */
    public function manageCustomer(CustomerRepository $customerRepository): Response
    {
        return $this->render('account/manageCustomer/customer.html.twig', [
            'customers' => $customerRepository->findAll(),
        ]);
    }

    //Ajouter un client
    /**
     * @Route("/admin/gestion-des-clients/nouveau-client", name="manageCustomerNew")
     */
    public function newCustomer(Request $request, EntityManagerInterface $entityManager): Response
    {
        $customer = new Customer();
        $form = $this->createForm(SignupFormType::class, $customer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $customer->setCustomerAdmin(0);
            $entityManager->persist($customer);
            $entityManager->flush();
            return $this->redirectToRoute("manageCustomer");
        }
        return $this->render("account/manageCustomer/customerNew&Update.html.twig",[
            "customer" => $customer,
            "form_customer" => $form->createView()
        ]);
    }

    //Afficher la fiche d'un client
    /**
     * @Route("/admin/gestion-des-clients/{id}", name="manageCustomerId")
     */
    public function manageCustomerId(Customer $customer, CustomerRepository $customerRepository): Response
    {
        return $this->render('account/manageCustomer/customerId.html.twig', [
            'customer' => $customer,
        ]);
    }

    //Mise à jour d'une fiche client
    /**
     * @Route("/admin/gestion-des-clients/modifier-client/{id}", name="manageCustomerUpdate")
     */
    public function updateCustomer(Customer $customer, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CustomerFormType::class, $customer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($customer);
            $entityManager->flush();

            return $this->redirectToRoute('manageCustomer');
        }

        return $this->render('account/manageCustomer/customerNew&Update.html.twig', [
            'customer' => $customer,
            'form_customer' => $form->createView(),
        ]);
    }
}