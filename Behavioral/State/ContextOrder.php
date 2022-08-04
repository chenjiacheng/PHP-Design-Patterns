<?php

declare(strict_types=1);

namespace DesignPatterns\Behavioral\State;

/**
 * 环境类
 */
class ContextOrder extends StateOrder
{
    public function getState(): StateOrder
    {
        return static::$state;
    }

    public function setState(StateOrder $state)
    {
        static::$state = $state;
    }

    public function done()
    {
        static::$state->done();
    }

    public function getStatus(): string
    {
        return static::$state->getStatus();
    }
}