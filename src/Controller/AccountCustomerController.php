<?php
	namespace App\Controller;
	use App\Entity\Customer;
	use App\Form\CustomerFormType;
	use Doctrine\ORM\EntityManagerInterface;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

	class AccountCustomerController extends AbstractController {
		/**
		 * @Route("/compte/{id}/modification", name="accountIdUpdate")
		 */
		public function updateCustomerId(Customer $customer, Request $request, EntityManagerInterface $entityManager): Response {
			// Edit personal account informations
			$form = $this->createForm(CustomerFormType::class, $customer);
			$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {
				$entityManager->persist($customer);
				$entityManager->flush();
				return $this->redirectToRoute("accountId", ["id" => $customer->getId()]);
			}
			return $this->render("account/edit.html.twig", [
				"account" => $customer,
				"form_customer" => $form->createView()
			]);
		}
	}
?>