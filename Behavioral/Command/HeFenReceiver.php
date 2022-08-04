<?php

declare(strict_types=1);

namespace DesignPatterns\Behavioral\Command;

// 接收者：河粉厨师
class HeFenReceiver
{
    public function cooking(): string
    {
        return '做好了河粉';
    }
}