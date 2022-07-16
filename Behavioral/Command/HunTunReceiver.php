<?php

declare(strict_types=1);

namespace Behavioral\Command;

// 接收者：馄饨厨师
class HunTunReceiver
{
    public function cooking(): string
    {
        return '做好了馄饨';
    }
}