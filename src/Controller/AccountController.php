<?php
	namespace App\Controller;
	use App\Session\Session;
	use Doctrine\ORM\EntityManagerInterface;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

	class AccountController extends AbstractController {
		/**
		 * @Route("/compte", name="account")
		 */
		public function account(Session $session): Response {
			if (!$session->get("customer")) return $this->redirectToRoute("login");
			else return $this->render("account/account.html.twig", [
				"account" => $session->get("customer")
			]);
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