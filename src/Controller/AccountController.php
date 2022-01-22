<?php
	namespace App\Controller;
	use App\Entity\Customer;
	use App\Form\EditAccountFormType;
	use App\Repository\CustomerRepository;
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
		public function account(Request $request, EntityManagerInterface $entityManager, Session $session): Response {
			if (!$session->get("customer")) return $this->redirectToRoute("login");
			else {
				$form = $this->createForm(EditAccountFormType::class);
				$form->handleRequest($request);
				// $customer = [];
				if ($form->isSubmitted() && $form->isValid()) {
					/*$customer = $customerRepository->findBy(array("id" => array_values($session->get("customer"))[0]));
					$customer[0]->setCustomerPassword($form["customer_password"]->getData());
					$entityManager->persist($customer);
					$entityManager->flush();*/
				}
				return $this->render("account/account.html.twig", [
					"account" => $session->get("customer"),
					// "customer" => $customer,
					"form" => $form->createView()
				]);
			}
		}
		/**
		 * @Route("/admin/", name="admin")
		 */
		public function adminAccount(): Response {
			return $this->render("account/admin.html.twig");
		}
		/**
		 * @Route("/deconnexion", name="disconnect")
		 */
		public function disconnect(Session $session): Response {
			$session->clear("customer");
			return $this->redirectToRoute("login");
		}
	}
?>