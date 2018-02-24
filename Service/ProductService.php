<?php

namespace Blue\StorageBundle\Service;

use Blue\StorageBundle\Command\DeleteProductCommand;
use Blue\StorageBundle\Command\ProductCommand;
use Blue\StorageBundle\Command\UpdateProductCommand;
use Blue\StorageBundle\Entity\Product;
use Blue\StorageBundle\Exceptions\AddProductException;
use Blue\StorageBundle\Exceptions\DeleteProductException;
use Blue\StorageBundle\Exceptions\UpdateProductException;
use Blue\StorageBundle\Query\MinAmountProductQuery;
use Blue\StorageBundle\Query\NonExistingProductQuery;
use Blue\StorageBundle\Query\ProductQuery;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ProductService
 * @package Blue\StorageBundle\Service
 */
class ProductService
{
    private const MIN_AMOUNT_PRODUCTS = 'amount <= 5';
    private const EXISTING_PRODUCTS = 'amount > 0';
    private const NON_EXISTING_PRODUCTS = 'amount = 0';

    /**
     * @var ObjectRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * ProductService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Product::class);
    }

    /**
     * @param ProductQuery $productQuery
     * @return array
     */
    public function getProduct(ProductQuery $productQuery) : array
    {
        if ($productQuery instanceof MinAmountProductQuery) {
            return $this->repository->findProducts($productQuery, self::MIN_AMOUNT_PRODUCTS);
        }

        if ($productQuery instanceof NonExistingProductQuery) {
            return $this->repository->findProducts($productQuery, self::NON_EXISTING_PRODUCTS);
        }

        return $this->repository->findProducts($productQuery, self::EXISTING_PRODUCTS);
    }

    /**
     * @param ProductCommand $productCommand
     * @return Product
     * @throws AddProductException
     */
    public function addProduct(ProductCommand $productCommand) : Product
    {
        try {
            $product = new Product();
            $product->setName($productCommand->getName());
            $product->setAmount($productCommand->getAmount());

            return $this->repository->addProduct($product);

        } catch (\Throwable $exception) {
            throw new AddProductException(
                $exception->getMessage(),
                AddProductException::ADD_PRODUCT_EXCEPTION_CODE,
                $exception
            );
        }
    }

    /**
     * @param UpdateProductCommand $updateProductCommand
     * @throws UpdateProductException
     * @return Product
     */
    public function updateProduct(UpdateProductCommand $updateProductCommand) : Product
    {
        try {
            return $this->repository->updateProduct($updateProductCommand);
        } catch (\Throwable $exception) {
            throw new UpdateProductException(
                $exception->getMessage(),
                AddProductException::ADD_PRODUCT_EXCEPTION_CODE,
                $exception
            );
        }
    }

    public function deleteProduct(DeleteProductCommand $deleteProductCommand)
    {
        try {
            //TODO
            $this->repository->deleteProduct($deleteProductCommand);
        } catch (\Throwable $exception) {
            throw new DeleteProductException(
                $exception->getMessage(),
                AddProductException::ADD_PRODUCT_EXCEPTION_CODE,
                $exception
            );
        }
    }




}