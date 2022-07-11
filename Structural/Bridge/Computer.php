<?php

declare(strict_types=1);

namespace Structural\Bridge;

// 抽象的电脑类型
abstract class Computer
{
    // 组合品牌（桥）
    protected Brand $brand;

    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }

    public function info(): string
    {
        return $this->brand->info(); // 自带品牌
    }
}