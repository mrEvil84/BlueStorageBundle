<?php

declare(strict_types = 1);

namespace Blue\StorageBundle\Query;

use Blue\StorageBundle\Entity\Product;

/**
 * Class GetProductByIdQuery
 * @package Blue\StorageBundle\Query
 */
class GetProductByIdQuery extends ProductQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetProductByIdQuery constructor.
     * @param int $id
     */
    public function __construct(int $id = Product::NULL_ID)
    {
        parent::__construct();
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

}