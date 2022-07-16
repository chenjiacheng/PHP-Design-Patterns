<?php

declare(strict_types=1);

use Behavioral\Interpreter\Context;
use PHPUnit\Framework\TestCase;

class InterpreterTest extends TestCase
{
    public function testFreeRide()
    {
        $bus = new Context();

        $this->assertSame($bus->freeRide('深圳的老人'), '本次乘车免费');
        $this->assertSame($bus->freeRide('深圳的年轻人'), '本次乘车扣费2元');
        $this->assertSame($bus->freeRide('广州的妇女'), '本次乘车免费');
        $this->assertSame($bus->freeRide('广州的儿童'), '本次乘车免费');
        $this->assertSame($bus->freeRide('东莞的儿童'), '本次乘车扣费2元');
    }
}
