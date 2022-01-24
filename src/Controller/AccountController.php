<?php
	namespace App\Controller;
	use App\Entity\Customer;
	use App\Entity\Order;
	use App\Repository\CustomerRepository;
	use App\Repository\OrderRepository;
	use App\Session\Session;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

	class AccountController extends AbstractController {
		/**
		 * @Route("/compte", name="account")
		 */
		public function account(OrderRepository $orderRepository, Session $session): Response {
			if ($session->get("customer")) {
				return $this->render("account/index.html.twig", [
					"account" => $session->get("customer"),
					"orders" => $orderRepository->findAll()
				]);
			} else return $this->redirectToRoute("login");
		}
		/**
		 * @Route("/compte/modifier", name="edit-account")
		 */
		public function editAccount(Request $request, Customer $customer, EntityManagerInterface $entityManager, Session $session): Response {
			// Edit personal account informations
			$form = $this->createForm(CustomerFormType::class, $customer);
			$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {
				$entityManager->persist($customer);
				$entityManager->flush();
				return $this->redirectToRoute("account");
			}
			return $this->render("account/edit.html.twig", [
				"account" => $customer,
				"form" => $form->createView()
			]);
		}
	}
?>