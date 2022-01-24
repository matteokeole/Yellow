<?php
	namespace App\Controller;
	use App\Entity\Product;
	use App\Form\SearchFormType;
	use App\Repository\ProductRepository;
	use App\Session\Session;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

	class ProductController extends AbstractController {
		/**
		* @Route("/mangas/{category}", name="catalog")
		*/
		public function catalog(Request $request, ProductRepository $productRepository): Response {
			$categories = $productRepository->searchCategory();
			$products = $productRepository->findAll();
			$category = "all";
			if ($request->get("category") != "all") {
				// This is a search by category
				// Select all products with the requested category
				$category = $request->get("category");
				$products = $productRepository->findBy(array("product_category" => $category));
			}
			return $this->render("product/catalog.html.twig", [
				"products" => $products,
				"categories" => $categories,
				"filter" => $category
			]);
		}
		/**
		* @Route("/manga/{id}", name="product")
		*/
		public function product(Product $product): Response {
			return $this->render("product/product.html.twig", [
				"product" => $product
			]);
		}
		/**
		* @Route("/ajouteraupanier/{id}", name="addtobasket")
		*/
		public function addToBasket(Product $product, Session $session): Response {
			if ($session->get("customer")) {
				// Add product to customer basket
			}
			// Redirect to the customer basket
			return $this->redirectToRoute("basket");
		}
	}
?>