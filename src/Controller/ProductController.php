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
		* @Route("/mangas", name="catalog")
		*/
		public function catalog(ProductRepository $productRepository, Request $request): Response {
			$categories = $productRepository->searchCategory();
			$categorySearch = $request->query->get("category_search", "");

			return $this->render("product/catalog.html.twig", [
				"category_search" => $categorySearch,
				"categories" => $categories,
				"products" => $productRepository->findAll()
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
		/**
		* @Route("/manga/{id}", name="product")
		*/
		public function product(Product $product): Response {
			return $this->render("product/product.html.twig", [
				"product" => $product
			]);
		}
		/**
		* @Route("/mangas/{category}", name="categorySearch")
		*/
		public function categorySearch(): Response {
			return $this->render("product/categorySearch.html.twig");
		}
	}
?>