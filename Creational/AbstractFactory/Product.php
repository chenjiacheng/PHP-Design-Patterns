<?php

declare(strict_types=1);

namespace Creational\AbstractFactory;

interface Product
{
    public function calculatePrice(): int;
}