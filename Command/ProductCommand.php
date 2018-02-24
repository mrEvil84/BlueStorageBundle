<?php

declare(strict_types = 1);

namespace Blue\StorageBundle\Command;

/**
 * Class ProductCommand
 * @package Blue\StorageBundle\Command
 */
abstract class ProductCommand
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $amount;

    /**
     * ProductCommand constructor.
     * @param int $id
     * @param string $name
     * @param int $amount
     */
    public function __construct(int $id, string $name, int $amount)
    {
        $this->id = $id;
        $this->name = $name;
        $this->amount = $amount;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

}