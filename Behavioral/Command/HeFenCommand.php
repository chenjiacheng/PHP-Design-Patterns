<?php

declare(strict_types=1);

namespace Behavioral\Command;

// 具体命令：河粉
class HeFenCommand implements BreakfastCommand
{
    protected HeFenReceiver $heFenReceiver;

    public function __construct()
    {
        $this->heFenReceiver = new HeFenReceiver();
    }

    public function execute(): string
    {
        return $this->heFenReceiver->cooking();
    }
}