<?php
	namespace App\Controller;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

	class AccountController extends AbstractController {
		/**
		 * @Route("/compte", name="account")
		 */
		public function index(): Response {
			if ($this->get("session")) {
				return $this->render("account/index.html.twig");
			} else return $this->redirectToRoute("login");
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