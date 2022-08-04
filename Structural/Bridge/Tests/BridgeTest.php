<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use DesignPatterns\Structural\Bridge\Apple;
use DesignPatterns\Structural\Bridge\Desktop;
use DesignPatterns\Structural\Bridge\Laptop;
use DesignPatterns\Structural\Bridge\Lenovo;

class BridgeTest extends TestCase
{
    public function testCanPrintUsingThePlainTextPrinter()
    {
        // 苹果笔记本
        $apple = new Apple();
        $computer = new Laptop($apple);
        $this->assertSame('苹果笔记本', $computer->info());

        // 联想台式机
        $lenovo = new Lenovo();
        $computer = new Desktop($lenovo);
        $this->assertSame('联想台式机', $computer->info());
    }
}
