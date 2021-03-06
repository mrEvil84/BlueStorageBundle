<?php

declare(strict_types = 1);

namespace Blue\StorageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="Blue\StorageBundle\Repository\ProductRepository")
 */
class Product
{
    public const NULL_ID = 0;
    public const NULL_NAME = '';
    public const NULL_AMOUNT = 0;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="amount", type="integer")
     */
    private $amount;


    /**
     * Get id
     *
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName(string $name) : Product
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     *
     * @return Product
     */
    public function setAmount(int $amount) : Product
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return int
     */
    public function getAmount() : int
    {
        return $this->amount;
    }
}

