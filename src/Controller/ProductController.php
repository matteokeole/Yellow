<?php
	namespace App\Controller;
	use App\Entity\Product;
	use App\Repository\ProductRepository;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

	class ProductController extends AbstractController {
		/**
		* @Route("/mangas", name="catalog")
		*/
		public function index(ProductRepository $productRepository): Response {
			return $this->render("product/index.html.twig", [
				"products" => $productRepository->findAll()
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
	}
?>