<?php

declare(strict_types=1);

namespace Structural\Bridge;

// 苹果品牌
class Apple implements Brand
{
    public function info(): string
    {
        return '苹果';
    }
}