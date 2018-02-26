<?php

namespace Blue\Tests\Unit\Command;

use Blue\StorageBundle\Command\CreateProductCommand;

/**
 * Class CreateProductCommandTest
 * @package Blue\Tests\Unit\Command
 */
class CreateProductCommandTest extends \PHPUnit\Framework\TestCase
{
    public function testCreateProductCommand()
    {
        $createProductCommand = new CreateProductCommand(1, 'test', 100);

        self::assertEquals(1, $createProductCommand->getId());
        self::assertEquals('test', $createProductCommand->getName());
        self::assertEquals(100, $createProductCommand->getAmount());

    }

}