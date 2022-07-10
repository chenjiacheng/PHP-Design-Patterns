<?php

declare(strict_types=1);

namespace Creational\Prototype;

class BarBookPrototype extends BookPrototype
{
    protected string $category = 'Bar';

    public function __clone()
    {
    }
}