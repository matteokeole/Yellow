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
			$updatedAccount = 0;
			if ($session->get("updated-account")) {
				$updatedAccount = $session->get("updated-account");
				$session->clear("updated-account");
			}
			if ($session->get("customer")) {
				$basket = $basketRepository->findBy(array("customer" => $session->get("customer")["id"]))[0];
				$order = $orderRepository->findBy(array("basket" => $basket->getId()));
				return $this->render("account/index.html.twig", [
					"account" => $session->get("customer"),
					"orders" => $order,
					"update" => $updatedAccount
				]);
			} else return $this->redirectToRoute("login");
		}
		/**
		 * @Route("/compte/commande{id}", name="consult-order")
		 */
		public function consulOrder(Order $order)
		{
			return $this->render("account/consult.html.twig", [
				'order' => $order,
			]);
		}
		/**
		 * @Route("/compte/modifier", name="edit-account")
		 */
		public function editAccount(
			Request $request,
			Session $session,
			EntityManagerInterface $entityManager,
			CustomerRepository $customerRepository
		): Response {
			// Edit personal account informations
			// Get customer entity
			$customer = $customerRepository->findBy(array("id" => $session->get("customer")["id"]))[0];
			// Get input values
			$first_name = $request->get("account_first_name");
			$last_name = $request->get("account_last_name");
			$email = $request->get("account_email");
			$phone = $request->get("account_phone");
			$password = $request->get("account_password");
			$address = $request->get("account_address");
			$post_code = $request->get("account_post_code");
			$city = $request->get("account_city");
			// Set input values on the customer
			if (strlen($first_name) > 0) $customer->setCustomerFirstName($first_name);
			if (strlen($last_name) > 0) $customer->setCustomerLastName($last_name);
			if (strlen($email) > 0) $customer->setCustomerEmail($email);
			$customer->setCustomerPhone($phone);
			if (strlen($password) > 0) $customer->setCustomerPassword($password);
			if (strlen($address) > 0) $customer->setCustomerAddress($address);
			if (strlen($post_code) > 0) $customer->setCustomerPostCode($post_code);
			if (strlen($city) > 0) $customer->setCustomerCity($city);
			// Update user session
			$session->clear("customer");
			$session->set("customer", [
				"id" => $customer->getId(),
				"admin" => $customer->getCustomerAdmin(),
				"first_name" => $customer->getCustomerFirstName(),
				"last_name" => $customer->getCustomerLastName(),
				"email" => $customer->getCustomerEmail(),
				"phone" => $customer->getCustomerPhone(),
				"password" => $customer->getCustomerPassword(),
				"address" => $customer->getCustomerAddress(),
				"post_code" => $customer->getCustomerPostCode(),
				"city" => $customer->getCustomerCity()
			]);
			// Commit changes
			$entityManager->flush();
			// Display "Account updated successfully" message after the form submit
			$session->set("updated-account", "Votre compte a été mis à jour.");
			// Redirect to account page
			return $this->redirectToRoute("account");
		}
	}
?>