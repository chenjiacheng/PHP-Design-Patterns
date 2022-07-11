<?php

declare(strict_types=1);

namespace Structural\Bridge;

// 台式电脑
class Desktop extends Computer
{
    public function info(): string
    {
        $brand = parent::info();
        return $brand . '台式机';
    }
}