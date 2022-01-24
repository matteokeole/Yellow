<?php
	namespace App\Controller;
	use App\Entity\Customer;
	use App\Entity\Order;
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
		public function account(OrderRepository $orderRepository, Session $session): Response {
			// Goto user account page if there is an active session
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
			$test = $request->get("customer_first_name");
			// return $this->redirectToRoute("account");
			return $this->render("account/index.html.twig", [
				"test" => $test
			]);
		}
	}
?>