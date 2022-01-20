<?php
	namespace App\Controller;
	use App\Entity\Product;
	use App\Form\ProductFormType;
	use App\Repository\ProductRepository;
	use Doctrine\ORM\EntityManagerInterface;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

	class InterfaceAdminController extends AbstractController {
		/**
		 * @Route("/admin", name="interfaceAdmin")
		 */
		public function index(): Response {
			return $this->render("account/admin.html.twig");
		}
		/**
		 * @Route("/admin/gestion-des-produits", name="manageProduct")
		 */
		public function manageProduct(ProductRepository $productRepository): Response {
			// Display database products
			return $this->render("account/manageProduct/product.html.twig", [
				"products" => $productRepository->findAll()
			]);
		}
		/**
		 * @Route("/admin/gestion-des-produits/nouveau-produit", name="manageProductNew")
		 */
		public function newProduct(Request $request, EntityManagerInterface $entityManager): Response {
			// Add a product to the database
			$product = new Product();
			$form = $this->createForm(ProductFormType::class, $product);
			$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {
				$entityManager->persist($product);
				$entityManager->flush();
				return $this->redirectToRoute("manageProduct");
			}
			return $this->render("account/manageProduct/productNew&Update.html.twig", [
				"product" => $product,
				"form_Product" => $form->createView()
			]);
		}
		/**
		 * @Route("/admin/gestion-des-produits/{id}", name="manageProductId")
		 */
		public function manageProductId(Product $product, ProductRepository $productRepository): Response {
			// Display product informations
			return $this->render("account/manageProduct/productId.html.twig", [
				"product" => $product
			]);
		}
		/**
		 * @Route("/admin/gestion-des-produits/modifier-produit/{id}", name="manageProductUpdate")
		 */
		public function updateProduct(Product $product, Request $request, EntityManagerInterface $entityManager): Response {
			// Update product informations
			$form = $this->createForm(ProductFormType::class, $product);
			$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {
				$entityManager->persist($product);
				$entityManager->flush();
				return $this->redirectToRoute("manageProduct");
			}
			return $this->render("account/manageProduct/productNew&Update.html.twig", [
				"product" => $product,
				"form_Product" => $form->createView()
			]);
		}
	}
?>