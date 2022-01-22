<?php
	namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

	class HomeController extends AbstractController {
	/**
	 * @Route("/", name="home")
	 */
	public function index(): Response {
		return $this->render("home/index.html.twig");
	}

	/**
	 * @Route("/recherche", name="search")
	 */
	public function search(Request $request){
		return $this->render('home/search.html.twig');
	}

}