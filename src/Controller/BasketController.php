<?php
	namespace App\Controller;
	use App\Entity\Basket;
	use App\Entity\Content;
	use App\Entity\Product;
	use App\Repository\BasketRepository;
	use App\Repository\ContentRepository;
	use App\Repository\ProductRepository;
	use App\Session\Session;
	use Doctrine\ORM\EntityManagerInterface;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

	class BasketController extends AbstractController {
		/**
		 * @Route("/panier", name="basket")
		 */
		public function basket(BasketRepository $basketRepository, Session $session): Response {
			// Display user basket content
			if ($session->get("customer")) {
				// There is an active session
				$basket = $basketRepository->findBy(array("customer" => $session->get("customer")["id"]))[0];
				// Render the basket page with the current user basket
				return $this->render("basket/index.html.twig");
			} else return $this->redirectToRoute("login");
		}
		/**
		* @Route("/ajouteraupanier/{id}", name="addtobasket")
		*/
		public function addToBasket(
			Request $request,
			EntityManagerInterface $entityManager,
			ProductRepository $productRepository,
			BasketRepository $basketRepository,
			ContentRepository $contentRepository,
			Session $session
		): Response {
			// Add product to customer basket
			if ($session->get("customer")) {
				// There is an active session
				$basket = $basketRepository->findBy(array("customer" => $session->get("customer")["id"]))[0];
				$product = $productRepository->findBy(array("id" => $request->get("id")))[0];
				// Create basket content
				$content = new Content();
				$content->setBasket($basket);
				$content->setProduct($product);
				$content->setContentProductQuantity(1);
				$entityManager->persist($content);
				// Commit changes
				$entityManager->flush();
				// Redirect to the customer basket
				return $this->redirectToRoute("basket");
				/*return $this->render("test.html.twig", [
					"basket" => $basket
				]);*/
			} else return $this->redirectToRoute("login");
		}
	}
?>