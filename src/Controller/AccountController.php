<?php
	namespace App\Controller;
	use App\Entity\Customer;
	use App\Entity\Order;
	use App\Repository\CustomerRepository;
	use App\Repository\OrderRepository;
	use App\Session\Session;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

	class AccountController extends AbstractController {
		/**
		 * @Route("/compte", name="account")
		 */
		public function account(OrderRepository $orderRepository, Session $session): Response {
			if ($session->get("customer")) {
				return $this->render("account/account.html.twig", [
					"account" => $session->get("customer"),
					"orders" => $orderRepository->findAllCustomer()
				]);
			} else return $this->redirectToRoute("login");
		}
		/**
		 * @Route("/admin", name="admin")
		 */
		public function admin(Session $session): Response {
			// Goto admin page if the user is admin
			if ($session->get("customer")["admin"] == 1) {
				return $this->render("account/admin.html.twig");
			} else return $this->redirectToRoute("account");
		}
		/**
		 * @Route("/deconnexion", name="disconnect")
		 */
		public function disconnect(Session $session): Response {
			// Clear session and disconnect user
			$session->clear("customer");
			return $this->redirectToRoute("login");
		}
	}
?>