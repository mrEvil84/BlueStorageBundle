<?php

declare(strict_types = 1);

namespace Blue\StorageBundle\Repository;

use Blue\StorageBundle\Command\UpdateProductCommand;
use Blue\StorageBundle\Entity\Product;
use Blue\StorageBundle\Exceptions\ProductNotFoundException;
use Blue\StorageBundle\Query\ProductQuery;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends EntityRepository
{
    /**
     * @param ProductQuery $productQuery
     * @param string $amountClause
     * @return array
     */
    public function findProducts(ProductQuery $productQuery, string $amountClause) : array
    {
        $sql = '
                  SELECT 
                    id, name, amount 
                  FROM 
                    product 
                  WHERE 
                     ' . $amountClause . ' 
                  ORDER BY 
                    name ' . $productQuery->getOrder() . '
                  LIMIT 
                    '.$productQuery->getPerPage().'
                  OFFSET
                    '.$productQuery->getPage();


        $query = $this->getEntityManager()->createNativeQuery($sql, $this->getResultMapping());

        return $query->getArrayResult();
    }

    /**
     * @return ResultSetMapping
     */
    private function getResultMapping() : ResultSetMapping
    {
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult(Product::class, 'p');
        $rsm->addFieldResult('p', 'id', 'id');
        $rsm->addFieldResult('p', 'name', 'name');
        $rsm->addFieldResult('p', 'amount', 'amount');

        return $rsm;
    }

    /**
     * @param Product $product
     * @throws OptimisticLockException
     * @throws ORMInvalidArgumentException
     * @return Product
     */
    public function addProduct(Product $product) : Product
    {
        $this->getEntityManager()->persist($product);
        $this->getEntityManager()->flush();

        return $product;
    }

    /**
     * @param UpdateProductCommand $updateProductCommand
     * @throws ORMInvalidArgumentException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws ProductNotFoundException
     * @return Product
     */
    public function updateProduct(UpdateProductCommand $updateProductCommand) : Product
    {
        $product = $this->getEntityManager()->find(Product::class,$updateProductCommand->getId());
        if (null === $product) {
            throw new ProductNotFoundException('Product not found');
        }

        $product->setName($updateProductCommand->getName());
        $product->setAmount($updateProductCommand->getAmount());
        $this->getEntityManager()->flush($product);

        return $product;
    }

}