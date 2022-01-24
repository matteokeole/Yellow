<?php
	namespace App\Controller;
	use App\Entity\Product;
	use App\Session\Session;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

	class BasketController extends AbstractController {
		/**
		 * @Route("/panier", name="basket")
		 */
		public function basket(Session $session): Response {
			// Display user basket content
			if ($session->get("customer")) {
				// There is an active session
				// Render the basket page with the current user basket
				return $this->render("basket/index.html.twig");
			} else return $this->redirectToRoute("login");
		}
		/**
		* @Route("/ajouteraupanier/{id}", name="addtobasket")
		*/
		public function addToBasket(Product $product, Session $session): Response {
			if ($session->get("customer")) {
				// Add product to customer basket
			}
			// Redirect to the customer basket
			// return $this->redirectToRoute("basket");
		}
	}
?>