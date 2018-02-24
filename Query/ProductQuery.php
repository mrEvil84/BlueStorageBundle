<?php

declare(strict_types=1);

namespace Blue\StorageBundle\Query;

/**
 * Class StorageQuery
 * @package Blue\StorageBundle
 */
abstract class ProductQuery
{
    public const SEARCH_PER_EXISTING = 'existing';
    public const SEARCH_PER_NON_EXISTING = 'non_existing';
    public const SEARCH_PER_MIN_AMOUNT = 'min_amount';
    public const DEFAULT_PAGE = 0;
    public const DEFAULT_PER_PAGE = 10;
    public const DEFAULT_ORDER = 'DESC';

    /**
     * @var string
     */
    protected $order;
    /**
     * @var int
     */
    protected $page;
    /**
     * @var int
     */
    protected $perPage;

    /**
     * StorageQuery constructor.
     * @param string $order ASC|DESC
     * @param int $page
     * @param int $perPage
     */
    public function __construct(string $order = 'ASC', int $page = self::DEFAULT_PAGE, int $perPage = self::DEFAULT_PER_PAGE)
    {
        $this->order = $order;
        $this->page = $page;
        $this->perPage = $perPage;
    }

    /**
     * @return string
     */
    public function getOrder() : string
    {
        return $this->order;
    }

    /**
     * @return int
     */
    public function getPage() : int
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getPerPage() : int
    {
        return $this->perPage;
    }

}