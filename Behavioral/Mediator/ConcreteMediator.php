<?php

declare(strict_types=1);

namespace DesignPatterns\Behavioral\Mediator;

// 具体中介者
class ConcreteMediator extends Mediator
{
    protected array $list = [];

    public function register(Colleague $colleague)
    {
        if ($colleague !== null) {
            $this->list[] = $colleague;
            $colleague->setMedium($this);
        }
    }

    public function relay()
    {
        // 通知所有人
        foreach ($this->list as $item) {
            $item->receive();
        }
    }
}