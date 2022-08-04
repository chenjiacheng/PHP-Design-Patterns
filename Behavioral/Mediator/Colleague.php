<?php

declare(strict_types=1);

namespace DesignPatterns\Behavioral\Mediator;

// 抽象同事类
abstract class Colleague
{
    protected Mediator $mediator;

    public function setMedium(Mediator $mediator)
    {
        $this->mediator = $mediator;
    }

    abstract public function receive();

    abstract public function send();
}