<?php

namespace Blue\Tests\Unit\Service;

use Blue\StorageBundle\Command\CreateProductCommand;
use Blue\StorageBundle\Command\DeleteProductCommand;
use Blue\StorageBundle\Command\UpdateProductCommand;
use Blue\StorageBundle\Entity\Product;
use Blue\StorageBundle\Query\ExistingProductsQuery;
use Blue\StorageBundle\Query\GetProductByIdQuery;
use Blue\StorageBundle\Query\MinAmountProductQuery;
use Blue\StorageBundle\Query\NonExistingProductQuery;
use Blue\StorageBundle\Query\ProductQuery;
use Blue\StorageBundle\Repository\ProductRepository;
use Blue\StorageBundle\Service\ProductService;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class ProductServiceTest
 * @package Blue\Tests\Unit\Service
 */
class ProductServiceTest extends TestCase
{
   public function testShouldInitialize()
   {
       $productService = new ProductService(self::getMock(EntityManager::class));

       self::assertInstanceOf(ProductService::class, $productService);
   }

    /**
     * @dataProvider getQueryCommands
     */
   public function testGetProduct($command)
   {
       $repository = self::getMock(ProductRepository::class);
       $repository->method('findProducts')
           ->willReturn(['id' => 1, 'name' => 'test', 'amount' => 20]);
       $repository->method('findOneProduct')
           ->willReturn(['id' => 1, 'name' => 'test', 'amount' => 20]);

       $productService = new ProductService(self::getMock(EntityManager::class), $repository);

       $rawData = $productService->getProduct($command);
       self::assertInstanceOf(ProductService::class, $productService);
       self::assertArrayHasKey('id', $rawData);
       self::assertArrayHasKey('name', $rawData);
       self::assertArrayHasKey('amount', $rawData);
   }

    public function testAddProduct()
    {
        $repository = self::getMock(ProductRepository::class);
        $repository->method('addProduct')->willReturn(new Product());
        $productService = new ProductService(self::getMock(EntityManager::class), $repository);
        $product = $productService->addProduct(new CreateProductCommand(Product::NULL_ID, 'test', 1000));
        self::assertInstanceOf(Product::class, $product);
    }

    public function testUpdateProduct()
    {
        $repository = self::getMock(ProductRepository::class);
        $repository->method('updateProduct')->willReturn(new Product());
        $productService = new ProductService(self::getMock(EntityManager::class), $repository);
        $product = $productService->addProduct(new UpdateProductCommand(1, 'test', 1000));
        self::assertInstanceOf(Product::class, $product);
    }

    public function testDeleteProduct()
    {
        $repository = self::getMock(ProductRepository::class);
        $repository->method('deleteProduct')->willReturn(new Product());
        $productService = new ProductService(self::getMock(EntityManager::class), $repository);
        $product = $productService->addProduct(new DeleteProductCommand(1, 'test', 1000));
        self::assertInstanceOf(Product::class, $product);
    }



    /**
     * @return array
     */
   public function getQueryCommands()
   {
       return [
           [
               new GetProductByIdQuery(1)
           ],
           [
               new ExistingProductsQuery('ASC', 1, 10)
           ],
           [
               new NonExistingProductQuery('DESC', 1, 10)
           ],
           [
               new MinAmountProductQuery('ASC', 1, 10)
           ]
       ];
   }


    /**
     * @param $name
     * @return MockObject
     */
   private function getMock($name)
   {
    return $this->getMockBuilder($name)
        ->disableOriginalConstructor()
        ->setMethods([])
        ->getMock();
    }

}