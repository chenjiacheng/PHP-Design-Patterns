<?php

declare(strict_types=1);

use Behavioral\State\CreateOrder;
use Behavioral\State\ShippingOrder;
use Behavioral\State\ContextOrder;
use PHPUnit\Framework\TestCase;

class StateTest extends TestCase
{
    public function testCanShipCreatedOrder()
    {
        $order = new CreateOrder();
        $contextOrder = new ContextOrder();
        $contextOrder->setState($order);
        $contextOrder->done();

        $this->assertEquals('shipping', $contextOrder->getStatus());
    }

    public function testCanCompleteShippedOrder()
    {
        $order = new ShippingOrder();
        $contextOrder = new ContextOrder();
        $contextOrder->setState($order);
        $contextOrder->done();

        $this->assertEquals('completed', $contextOrder->getStatus());
    }
}
