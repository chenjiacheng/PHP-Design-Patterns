<?php

declare(strict_types=1);

namespace Structural\Bridge;

// 笔记本电脑
class Laptop extends Computer
{
    public function info(): string
    {
        $brand = parent::info();
        return $brand . '笔记本';
    }
}