<?php

declare(strict_types=1);

namespace Creational\SimpleFactory;

class Bicycle
{
    public function driveTo(string $destination): string
    {
        return $destination;
    }
}