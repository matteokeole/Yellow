<?php
	namespace App\Controller;
	use App\Entity\Customer;
	use App\Repository\CustomerRepository;
	use App\Form\LoginFormType;
	use App\Form\SignupFormType;
	use Doctrine\ORM\EntityManagerInterface;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Session\Session;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

	class AccountController extends AbstractController {
		/**
		 * @Route("/connexion", name="login")
		 */
		public function index(Request $request, CustomerRepository $customerRepository): Response {
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
						$session = new Session();
						$session->start();
						$session->set("id", $customer->getId());
						return $this->redirectToRoute("home");
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
		public function newInscription(Request $request, EntityManagerInterface $entityManager): Response {
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
		public function index(): Response {
			if ($this->get("session")) {
				return $this->render("account/index.html.twig");
			} else return $this->redirectToRoute("login");
		}
		/**
		 * @Route("/compte/admin/{id}", name="compte_admin")
		 */
		public function connexionAdmin(): Response {
			return $this->render("account/admin.html.twig");
		}
		/**
		 * @Route("/deconnexion", name="disconnect")
		 */
		public function disconnect(): Response {
			$session->clear();
			$this->redirectToRoute("home");
		}
	}
?>