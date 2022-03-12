<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Product Repository
 * 
 * @author David Dakhli <dakli.david@gmail.com>
 * 
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findByCategoryQueryBuilder(Category $category)
    {
        $query = $this->createQueryBuilder('product')
            ->innerJoin('product.categories', 'category')
            ->where('category = :category')
            ->setParameter('category', $category);

        return $query;
    }
}
