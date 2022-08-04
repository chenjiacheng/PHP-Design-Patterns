<?php

declare(strict_types=1);

namespace DesignPatterns\Structural\Bridge;

// 联想品牌
class Lenovo implements Brand
{
    public function name(): string
    {
        return '联想';
    }
}