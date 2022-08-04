<?php

declare(strict_types=1);

namespace DesignPatterns\Behavioral\Command;

// 具体命令：肠粉
class ChangFenCommand implements BreakfastCommand
{
    protected ChangFenReceiver $changFenReceiver;

    public function __construct()
    {
        $this->changFenReceiver = new ChangFenReceiver();
    }

    public function execute(): string
    {
        return $this->changFenReceiver->cooking();
    }
}