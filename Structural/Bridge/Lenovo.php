<?php

declare(strict_types=1);

namespace Structural\Bridge;

// 联想品牌
class Lenovo implements Brand
{
    public function info(): string
    {
        return '联想';
    }
}