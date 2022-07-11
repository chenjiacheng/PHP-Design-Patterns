<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Structural\Bridge\Apple;
use Structural\Bridge\Desktop;
use Structural\Bridge\Laptop;
use Structural\Bridge\Lenovo;

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
