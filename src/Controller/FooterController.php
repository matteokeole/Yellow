<?php
	namespace App\Controller;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

	class FooterController extends AbstractController {
		/**
		 * @Route("/cgv", name="cgv")
		 */
		public function cgv(): Response {
			return $this->render("footer/cgv.html.twig");
		}
		/**
		 * @Route("/mentions-legales", name="mentions-legales")
		 */
		public function mentionsLegales(): Response {
			return $this->render("footer/mentions-legales.html.twig");
		}
		/**
		 * @Route("/retours-remboursements", name="retours-remboursements")
		 */
		public function retoursRemboursements(): Response {
			return $this->render("footer/retours-remboursements.html.twig");
		}
	}
?>