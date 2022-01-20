<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\InscriptionFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConnexionController extends AbstractController
{
    /**
     * @Route("/compte", name="compte")
     */
    public function index(): Response
    {
        return $this->render('connexion/index.html.twig', [
            'controller_name' => 'ConnexionController',
        ]);
    }
    /**
     * @Route("/compte/admin/{id}", name="compte_admin")
     */
    public function connexionAdmin(): Response
    {
        return $this->render('interface_admin/index.html.twig');
    }
    /**
     * @Route("/compte/customer/{id}", name="compte_customer")
     */
    public function connexionCustomer(): Response
    {
        return $this->render('interface_customer/index.html.twig');
    }
    /**
     * @Route("/compte/inscription", name="inscription")
     */
    public function newInscription(Request $request, EntityManagerInterface $entityManager): Response
    {
        $customer = new Customer();
        $form = $this->createForm(InscriptionFormType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($customer);
            $entityManager->flush();

            return $this->redirectToRoute('compte');
        }
        return $this->render('connexion/inscription.html.twig',[
            'customer' => $customer,
            'form_inscription' => $form->createView(),
        ]);
    }

}
