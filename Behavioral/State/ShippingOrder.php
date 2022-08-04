<?php

declare(strict_types=1);

namespace DesignPatterns\Behavioral\State;

/**
 * 具体状态类
 */
class ShippingOrder extends StateOrder
{
    public function __construct()
    {
        $this->setStatus('shipping');
    }

    protected function done()
    {
        $this->setStatus('completed');
    }
}