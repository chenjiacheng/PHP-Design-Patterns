<?php

declare(strict_types=1);

namespace Creational\StaticFactory\Tests;

use Creational\StaticFactory\FormatNumber;
use Creational\StaticFactory\FormatString;
use Creational\StaticFactory\StaticFactory;
use PHPUnit\Framework\TestCase;

class StaticFactoryTest extends TestCase
{
    public function testCanCreateNumberFormatter()
    {
        $this->assertInstanceOf(FormatNumber::class, StaticFactory::factory('number'));
    }

    public function testCanCreateStringFormatter()
    {
        $this->assertInstanceOf(FormatString::class, StaticFactory::factory('string'));
    }
}