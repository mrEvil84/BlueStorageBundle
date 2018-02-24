<?php

declare(strict_types = 1);

namespace Blue\StorageBundle\Exceptions;

/**
 * Class AddProductException
 * @package Blue\StorageBundle\Exceptions
 */
class ProductNotFoundException extends \Exception
{
    public const UPDATE_PRODUCT_EXCEPTION_CODE = 3000;
}