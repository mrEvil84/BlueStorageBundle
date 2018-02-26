<?php

namespace Blue\Tests\Unit\Query;

use Blue\StorageBundle\Query\ExistingProductsQuery;
use Blue\StorageBundle\Query\MinAmountProductQuery;
use Blue\StorageBundle\Query\NonExistingProductQuery;
use Blue\StorageBundle\Query\ProductQuery;
use Blue\StorageBundle\Query\ProductQueryFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class ProductQueryFactoryTest
 * @package Blue\Tests\Unit\Query
 */
class ProductQueryFactoryTest extends TestCase
{
    public function testCreateNonExistingProductQuery()
    {
        $nonExistingProductQuery = ProductQueryFactory::getProductQuery(
            ProductQuery::SEARCH_PER_NON_EXISTING,
            'ASC',
            1,
            10
        );

        self::assertInstanceOf(NonExistingProductQuery::class, $nonExistingProductQuery);
    }

    public function testCreateMinAmountProductQuery()
    {
        $nonExistingProductQuery = ProductQueryFactory::getProductQuery(
            ProductQuery::SEARCH_PER_MIN_AMOUNT,
            'ASC',
            1,
            10
        );

        self::assertInstanceOf(MinAmountProductQuery::class, $nonExistingProductQuery);
    }

    public function testCreateExistingProductQuery()
    {
        $nonExistingProductQuery = ProductQueryFactory::getProductQuery(
            ProductQuery::SEARCH_PER_EXISTING,
            'ASC',
            1,
            10
        );

        self::assertInstanceOf(ExistingProductsQuery::class, $nonExistingProductQuery);
    }


}