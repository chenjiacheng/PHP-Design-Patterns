<?php

declare(strict_types=1);

namespace Behavioral\Command;

// 接收者：肠粉厨师
class ChangFenReceiver
{
    public function cooking(): string
    {
        return '做好了肠粉';
    }
}