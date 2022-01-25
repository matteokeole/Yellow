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
		* @Route("/mangas/{category}", name="catalog")
		*/
		public function catalog(Request $request, ProductRepository $productRepository): Response {
			$categories = $productRepository->searchCategory();
			$category = $request->get("category");
			$offset = max(0, $request->query->getInt('offset', 0));
			$paginator = $productRepository->getProductPaginator($offset, $category);
			return $this->render("product/catalog.html.twig", [
				"products" => $paginator,
				"previous" => $offset - ProductRepository::PAGINATOR_PER_PAGE,
				"next" => min (count($paginator), $offset + ProductRepository::PAGINATOR_PER_PAGE),
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
	}
?>