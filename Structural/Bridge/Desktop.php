<?php

declare(strict_types=1);

namespace DesignPatterns\Structural\Bridge;

// 台式电脑
class Desktop extends Computer
{
    public function info(): string
    {
        return $this->brand->name() . '台式机';
    }
}