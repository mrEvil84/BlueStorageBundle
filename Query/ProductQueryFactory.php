<?php

namespace Blue\StorageBundle\Query;

/**
 * Class ProductQueryFactory
 * @package Blue\StorageBundle\Query
 */
class ProductQueryFactory
{
    /**
     * @param string $search
     * @param string $order
     * @param int $page
     * @param int $perPage
     * @return ExistingProductsQuery|MinAmountProductQuery|NonExistingProductQuery
     */
    public static function getProductQuery(
        string $search = ProductQuery::SEARCH_PER_EXISTING,
        string $order = ProductQuery::DEFAULT_ORDER,
        int $page = ProductQuery::DEFAULT_PAGE,
        int $perPage = ProductQuery::DEFAULT_PER_PAGE
    )
    {
        if (ProductQuery::SEARCH_PER_NON_EXISTING === $search) {
            return new NonExistingProductQuery($order, $page, $perPage);
        }

        if (ProductQuery::SEARCH_PER_MIN_AMOUNT === $search) {
            return new MinAmountProductQuery($order, $page, $perPage);
        }

        return new ExistingProductsQuery($order, $page, $perPage);
    }
}