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
		* @Route("/produit", name="produit")
		*/
		public function index(ProductRepository $productRepository) : Response
		{
			return $this->render('product/index.html.twig', [
				'products' => $productRepository->findAll(),
			]);
		}

		/**
		* @Route("/produit/{id}", name="ficheProduit")
		*/
		public function product(Product $product): Response
		{
			return $this->render('product/product.html.twig', [
				'ficheProduit' => $product]);
		}
	}
?>