<?php

declare(strict_types=1);

namespace Behavioral\State;

/**
 * 具体状态类
 */
class CreateOrder extends StateOrder
{
    public function __construct()
    {
        $this->setStatus('created');
    }

    protected function done()
    {
        static::$state = new ShippingOrder();
    }
}