<?php

namespace Blue\Tests\Unit\Command;

use Blue\StorageBundle\Command\CreateProductCommand;
use PHPUnit\Framework\TestCase;

/**
 * Class CreateProductCommandTest
 * @package Blue\Tests\Unit\Command
 */
class CreateProductCommandTest extends TestCase
{
    public function testCreateProductCommand()
    {
        $createProductCommand = new CreateProductCommand(1, 'test', 100);
        self::assertEquals(1, $createProductCommand->getId());
        self::assertEquals('test', $createProductCommand->getName());
        self::assertEquals(100, $createProductCommand->getAmount());
    }

}