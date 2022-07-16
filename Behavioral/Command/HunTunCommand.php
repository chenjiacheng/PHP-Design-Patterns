<?php

declare(strict_types=1);

namespace Behavioral\Command;

// 具体命令：馄饨
class HunTunCommand implements BreakfastCommand
{
    protected HunTunReceiver $hunTunReceiver;

    public function __construct()
    {
        $this->hunTunReceiver = new HunTunReceiver();
    }

    public function execute(): string
    {
        return $this->hunTunReceiver->cooking();
    }
}