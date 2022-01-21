<?php
	namespace App\Controller;
	use App\Entity\Customer;
	use App\Entity\Order;
	use App\Form\CustomerFormType;
	use App\Repository\OrderRepository;
	use Doctrine\ORM\EntityManagerInterface;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

	class AccountCustomerController extends AbstractController {
		// Afficher le compte du client
		/**
		 * @Route("/compte/{id}", name="accountId")
		 */
		public function manageCustomerId(Customer $customer, OrderRepository $orderRepository): Response {
			return $this->render("account/account.html.twig", [
				"customer" => $customer,
				"orders" => $orderRepository->findAllCustomer() 
			]);
		}
		// Modification données personnelles
		// Mise à jour d"une fiche client
		/**
		 * @Route("/compte/{id}/modification", name="accountIdUpdate")
		 */
		public function updateCustomerId(Customer $customer, Request $request, EntityManagerInterface $entityManager): Response {
			$form = $this->createForm(CustomerFormType::class, $customer);
			$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {
				$entityManager->persist($customer);
				$entityManager->flush();
				return $this->redirectToRoute("accountId", ["id" => $customer->getId()]);
			}
			return $this->render("account/accountUpdate.html.twig", [
				"customer" => $customer,
				"form_customer" => $form->createView()
			]);
		}
	}
?>