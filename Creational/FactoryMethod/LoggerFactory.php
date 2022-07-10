<?php

declare(strict_types=1);

namespace Creational\FactoryMethod;

interface LoggerFactory
{
    public function createLogger(): Logger;
}