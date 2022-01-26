<?php
	namespace App\Controller;
	use App\Entity\Customer;
	use App\Entity\Order;
	use App\Entity\Product;
	use App\Form\CustomerFormType;
	use App\Form\OrderFormType;
	use App\Form\ProductFormType;
	use App\Repository\CustomerRepository;
	use App\Repository\OrderRepository;
	use App\Repository\ProductRepository;
	use App\Session\Session;
	use Doctrine\ORM\EntityManagerInterface;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

	class AdminController extends AbstractController {
		/**
		 * @Route("/admin", name="admin")
		 */
		public function admin(Session $session): Response {
			// Goto admin page if the user is admin
			if (is_array($session->get("customer")) && $session->get("customer")["admin"] == 1) {
				return $this->render("admin/index.html.twig");
			} else return $this->redirectToRoute("account");
		}
		// Customer edition routes
		/**
		 * @Route("/admin/utilisateurs", name="customer-list")
		 */
		public function customerList(CustomerRepository $customerRepository): Response {
			// Display database customers
			return $this->render("admin/customer/index.html.twig", [
				"customers" => $customerRepository->findAll()
			]);
		}
		/**
		 * @Route("/admin/utilisateurs/nouveau", name="new-customer")
		 */
		public function newCustomer(Request $request, EntityManagerInterface $entityManager): Response {
			// Add new customer
			$customer = new Customer();
			$form = $this->createForm(CustomerFormType::class, $customer);
			$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {
				$customer->setCustomerAdmin(0);
				$entityManager->persist($customer);
				$entityManager->flush();
				return $this->redirectToRoute("customer-list");
			}
			return $this->render("admin/customer/edit.html.twig",[
				"customer" => $customer,
				"form" => $form->createView()
			]);
		}
		/**
		 * @Route("/admin/utilisateurs/nouvel-admin", name="new-admin")
		 */
		public function newAdmin(Request $request, EntityManagerInterface $entityManager): Response {
			// Add new admin
			$customer = new Customer();
			$form = $this->createForm(CustomerFormType::class, $customer);
			$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {
				$customer->setCustomerAdmin(1);
				$entityManager->persist($customer);
				$entityManager->flush();
				return $this->redirectToRoute("customer-list");
			}
			return $this->render("admin/customer/edit.html.twig",[
				"customer" => $customer,
				"form" => $form->createView()
			]);
		}
		/**
		 * @Route("/admin/utilisateurs/{id}", name="edit-customer")
		 */
		public function editCustomer(Request $request, Customer $customer, EntityManagerInterface $entityManager): Response {
			// Edit customer informations
			$form = $this->createForm(CustomerFormType::class, $customer);
			$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {
				$entityManager->persist($customer);
				$entityManager->flush();
				return $this->redirectToRoute("customer-list");
			}
			return $this->render("admin/customer/edit.html.twig", [
				"customer" => $customer,
				"form" => $form->createView()
			]);
		}
		/**
		* @Route("/admin/utilisateurs/supprimer/{id}", name="remove-customer")
		*/
		public function removeUser(Request $request, CustomerRepository $customerRepository, EntityManagerInterface $entityManager): Response {
			// Remove customer from user list
			$customer = $customerRepository->findBy(array("id" => $request->get("id")))[0];
			$entityManager->remove($customer);
			// Commit changes
			$entityManager->flush();
			// Redirect to the user list
			return $this->redirectToRoute("customer-list");
		}
		// Order edition routes
		/**
		 * @Route("/admin/commandes", name="order-list")
		 */
		public function orderList(OrderRepository $orderRepository): Response {
			// Display database orders
			return $this->render("admin/order/index.html.twig", [
				"orders" => $orderRepository->findAll()
			]);
		}
		/**
		 * @Route("/admin/commandes/{id}", name="remove-order")
		 */
		public function removeOrder(Request $request, OrderRepository $orderRepository, EntityManagerInterface $entityManager): Response {
			// Remove order from order list
			$order = $orderRepository->findBy(array("id" => $request->get("id")))[0];
			$entityManager->remove($order);
			// Commit changes
			$entityManager->flush();
			// Redirect to the order list
			return $this->redirectToRoute("order-list");
		}
		// Product edition routes
		/**
		 * @Route("/admin/produits", name="product-list")
		 */
		public function productList(ProductRepository $productRepository): Response {
			// Display database products
			return $this->render("admin/product/index.html.twig", [
				"products" => $productRepository->findAll()
			]);
		}
		/**
		 * @Route("/admin/produits/nouveau", name="new-product")
		 */
		public function newProduct(Request $request, EntityManagerInterface $entityManager): Response {
			// Add new products to the database
			$product = new Product();
			$form = $this->createForm(ProductFormType::class, $product);
			$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {
				$entityManager->persist($product);
				$entityManager->flush();
				return $this->redirectToRoute("product-list");
			}
			return $this->render("admin/product/edit.html.twig", [
				"product" => $product,
				"form" => $form->createView()
			]);
		}
		/**
		 * @Route("/admin/produits/{id}", name="edit-product")
		 */
		public function editProduct(Request $request, Product $product, EntityManagerInterface $entityManager): Response {
			// Edit product informations
			$form = $this->createForm(ProductFormType::class, $product);
			$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid()) {
				$entityManager->persist($product);
				$entityManager->flush();
				return $this->redirectToRoute("product-list");
			}
			return $this->render("admin/product/edit.html.twig", [
				"product" => $product,
				"form" => $form->createView()
			]);
		}
		/**
		* @Route("/admin/product/{id}", name="remove-product")
		*/
		public function removeProduct(Request $request, ProductRepository $productRepository, EntityManagerInterface $entityManager): Response {
			// Remove product from product list
			$product = $productRepository->findBy(array("id" => $request->get("id")))[0];
			$entityManager->remove($product);
			// Commit changes
			$entityManager->flush();
			// Redirect to the product list
			return $this->redirectToRoute("product-list");
		}
	}
?>