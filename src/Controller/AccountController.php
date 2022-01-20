<?php
	namespace App\Controller;
	use App\CustomerSession\CustomerSession;
	use App\Entity\Customer;
	use App\Form\LoginFormType;
	use App\Form\SignupFormType;
	use App\Repository\CustomerRepository;
	use Doctrine\ORM\EntityManagerInterface;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpFoundation\Session\Session;
	use Symfony\Component\HttpFoundation\Session\SessionInterface;
	use Symfony\Component\Routing\Annotation\Route;

	class AccountController extends AbstractController {
		/**
		 * @Route("/connexion", name="login")
		 */
		public function login(Request $request, CustomerRepository $customerRepository, CustomerSession $session): Response {
			$form = $this->createForm(LoginFormType::class);
			$form->handleRequest($request);
			$loginError = 0;
			if ($form->isSubmitted() && $form->isValid()) {
				$email = $form["customer_email"]->getData();
				$password = $form["customer_password"]->getData();
				$customers = $customerRepository->findAll();
				$loginError = 1;
				foreach ($customers as $customer) {
					if (
						$customer->getCustomerEmail() == $email &&
						$customer->getCustomerPassword() == $password
					) {
						// User successfully connected
						$session->set("customer", [
							"id" => $customer->getId(),
							"first_name" => $customer->getCustomerFirstName(),
							"last_name" => $customer->getCustomerLastName(),
							"email" => $customer->getCustomerEmail()
						]);
						return $this->redirectToRoute("account");
					}
				}
			}
			return $this->render("account/login.html.twig", [
				"form" => $form->createView(),
				"loginError" => $loginError
			]);
		}
		/**
		 * @Route("/inscription", name="signup")
		 */
		public function signup(Request $request, EntityManagerInterface $entityManager): Response {
			$customer = new Customer();
			$form = $this->createForm(SignupFormType::class, $customer);
			$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {
				$customer->setCustomerAdmin(0);
				$entityManager->persist($customer);
				$entityManager->flush();
				return $this->redirectToRoute("login");
			}
			return $this->render("account/signup.html.twig", [
				"customer" => $customer,
				"form" => $form->createView()
			]);
		}
		/**
		 * @Route("/compte", name="account")
		 */
		public function account(CustomerSession $session): Response {
			if (!$session->get("customer")) return $this->redirectToRoute("login");
			else return $this->render("account/account.html.twig", [
				"account" => $session->get("customer")
			]);
		}
		/**
		 * @Route("/compte/admin/{id}", name="compte_admin")
		 */
		public function adminAccount(): Response {
			return $this->render("account/admin.html.twig");
		}
		/**
		 * @Route("/deconnexion", name="disconnect")
		 */
		public function disconnect(CustomerSession $session): Response {
			$session->clear("customer");
			return $this->redirectToRoute("login");
		}
	}
?>