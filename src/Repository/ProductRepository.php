<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Product::class);
	}

	public function searchCategory(){
		$query = $this->createQueryBuilder('c')
		->select('c.product_category')
		->distinct(true)
		->getQuery();

		$categories = [];
		foreach ($query->getResult() as $cols) {
			$categories[] = $cols['product_category'];
		}
		return $categories;
	}

    public function getProductStock(){
        $stocks = [];
        foreach ($this->createQueryBuilder('p')
        ->select('p.product_stock')
        ->distinct(true)
        ->getQuery()
        ->getResult() as $cols){
            $stocks[] = $cols['product_stock'];
        }
        return $stocks;
    }

	public function searchName($value) {
		return $this->createQueryBuilder("p")
			->andWhere("p.product_name LIKE :query")
			->setParameter("query", "%" . $value . "%")
			->getQuery()
			->getResult();
	}

	public const PAGINATOR_PER_PAGE = 8;

	public function getProductPaginator (int $offset, string $category): Paginator
	{
		$query = $this->createQueryBuilder('p')
			->orderBy('p.product_price', 'ASC');

		if ($category != 'all') {
			$query = $query->andWhere('p.product_category = :category')->setParameter('category', $category);
		}

		$query = $query->setMaxResults(self::PAGINATOR_PER_PAGE)
			->setFirstResult($offset)
			->getQuery()
			;

		return new Paginator($query);
	}

	// /**
	//  * @return Product[] Returns an array of Product objects
	//  */
	/*
	public function findByExampleField($value)
	{
		return $this->createQueryBuilder('p')
			->andWhere('p.exampleField = :val')
			->setParameter('val', $value)
			->orderBy('p.id', 'ASC')
			->setMaxResults(10)
			->getQuery()
			->getResult()
		;
	}
	*/

	/*
	public function findOneBySomeField($value): ?Product
	{
		return $this->createQueryBuilder('p')
			->andWhere('p.exampleField = :val')
			->setParameter('val', $value)
			->getQuery()
			->getOneOrNullResult()
		;
	}
	*/
}
