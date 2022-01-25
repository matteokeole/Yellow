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
		public function basket(BasketRepository $basketRepository, ContentRepository $contentRepository, ProductRepository $productRepository, Session $session): Response {
			// Display user basket content
			if ($session->get("customer")) {
				// There is an active session
				// Get basket content
				$basket = $basketRepository->findBy(array("customer" => $session->get("customer")["id"]))[0];
				$content = $contentRepository->findBy(array("basket" => $basket->getId()));
				$products = [];
				for ($i = 0; $i < count($content); $i++) {
					array_push($products, $productRepository->findBy(array("id" => $content[$i]->getProduct()))[0]);
				}
				// Render the basket page with the current user basket
				return $this->render("basket/index.html.twig", [
					"content" => $content,
					"items" => $products
				]);
			} else return $this->redirectToRoute("login");
		}
		/**
		* @Route("/ajouteraupanier/{id}", name="add-to-basket")
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
				$content = $contentRepository->findBy(array(
					"basket" => $basket->getId(),
					"product" => $request->get("id")
				));
				if (array($content) && count($content) == 1) {
					// The product is already in the basket
					// Increment product quantity by 1
					$content[0]->setContentProductQuantity($content[0]->getContentProductQuantity() + 1);
				} else {
					// Create basket content
					$content = new Content();
					$content->setBasket($basket);
					$content->setProduct($product);
					$content->setContentProductQuantity(1);
					$entityManager->persist($content);
				}
				// Commit changes
				$entityManager->flush();
				// Redirect to the customer basket
				return $this->redirectToRoute("basket");
			} else return $this->redirectToRoute("login");
		}
		/**
		* @Route("/quantite/{id}/{quantity}", name="edit-quantity")
		*/
		public function editQuantity(Request $request, EntityManagerInterface $entityManager, ContentRepository $contentRepository): Response {
			// Remove product from customer basket
			$content = $contentRepository->findBy(array("id" => $request->get("id")))[0];
			$content->setContentProductQuantity($request->get("quantity"));
			// Commit changes
			$entityManager->flush();
			// Redirect to the customer basket
			return $this->redirectToRoute("basket");
		}
		/**
		* @Route("/supprimerdupanier/{id}", name="remove-from-basket")
		*/
		public function removeFromBasket(Request $request, EntityManagerInterface $entityManager, ContentRepository $contentRepository): Response {
			// Remove product from customer basket
			$content = $contentRepository->findBy(array("id" => $request->get("id")));
			foreach ($content as $item) {
				$entityManager->remove($item);
			}
			// Commit changes
			$entityManager->flush();
			// Redirect to the customer basket
			return $this->redirectToRoute("basket");
		}
	}
?>