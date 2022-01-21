<?php
	namespace App\Controller;
	use App\Entity\Customer;
	use App\Form\LoginFormType;
	use App\Form\SignupFormType;
	use App\Repository\CustomerRepository;
	use App\Session\Session;
	use Doctrine\ORM\EntityManagerInterface;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

	class ConnectionController extends AbstractController {
		/**
		 * @Route("/connexion", name="login")
		 */
		public function login(Request $request, CustomerRepository $customerRepository, Session $session): Response {
			// Login
			$form = $this->createForm(LoginFormType::class);
			$form->handleRequest($request);
			$loginError = 0;
			if ($form->isSubmitted() && $form->isValid()) {
				$loginError = 1;
				// Get customers list
				$customers = $customerRepository->findAll();
				foreach ($customers as $customer) {
					if (
						$customer->getCustomerEmail() == $form["customer_email"]->getData() &&
						$customer->getCustomerPassword() == md5($form["customer_password"]->getData())
					) {
						// User successfully connected
						$loginError = 0;
						// Create session
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
			return $this->render("connection/login.html.twig", [
				"form" => $form->createView(),
				"loginError" => $loginError
			]);
		}
		/**
		 * @Route("/inscription", name="signup")
		 */
		public function signup(Request $request, CustomerRepository $customerRepository, EntityManagerInterface $entityManager): Response {
			// Signup
			$signupError = 0;
			$customer = new Customer();
			$form = $this->createForm(SignupFormType::class, $customer);
			$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {
				// Check if the e-mail is not already used
				// Get customers list
				$customers = $customerRepository->findAll();
				$email_already_used = false;
				foreach ($customers as $c) {
					if ($c->getCustomerEmail() == $form["customer_email"]->getData()) $email_already_used = true;
				}
				if ($email_already_used) {
					// Used e-mail, return error
					$signupError = 1;
				} else {
					// Set customer admin parameter to 0
					$customer->setCustomerAdmin(0);
					$entityManager->persist($customer);
					$entityManager->flush();
					return $this->redirectToRoute("login");
				}
			}
			return $this->render("connection/signup.html.twig", [
				"form" => $form->createView(),
				"signupError" => $signupError
			]);
		}
	}
?>