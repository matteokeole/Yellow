<?php
	namespace App\Controller;
	use App\Entity\Customer;
	use App\Entity\Order;
	use App\Form\CustomerFormType;
	use App\Repository\BasketRepository;
	use App\Repository\CustomerRepository;
	use App\Repository\OrderRepository;
	use App\Session\Session;
	use Doctrine\ORM\EntityManagerInterface;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

	class AccountController extends AbstractController {
		/**
		 * @Route("/compte", name="account")
		 */
		public function account(OrderRepository $orderRepository, Session $session, BasketRepository $basketRepository): Response {
			// Goto user account page if there is an active session
			if ($session->get("customer")) {
				$basket = $basketRepository->findBy(array("customer" => $session->get("customer")["id"]))[0];
				$order = $orderRepository->findBy(array("basket" => $basket->getId()));

				return $this->render("account/index.html.twig", [
					"account" => $session->get("customer"),
					"basket" => $basket,
					"orders" => $order
				]);
			} else return $this->redirectToRoute("login");
		}
		/**
		 * @Route("/compte/modifier", name="edit-account")
		 */
		public function editAccount(Request $request, Customer $customer, EntityManagerInterface $entityManager, Session $session): Response {
			// Edit personal account informations
			// $test = $request->get("customer_first_name");
			$form = $this->createForm(CustomerFormType::class, $customer);
			$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {
				$entityManager->persist($customer);
				$entityManager->flush();
				return $this->redirectToRoute("edit-account");

			// return $this->redirectToRoute("account");
			return $this->render("account/index.html.twig", [
				// "test" => $test,
				"customer" => $customer,
				"form" => $form->createView()
			]);
			}
		}
	}
?>