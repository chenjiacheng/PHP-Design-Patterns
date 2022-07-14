<?php

declare(strict_types=1);

namespace Behavioral\Strategy;

interface ComparatorInterface
{
    /**
     * @param mixed $a
     * @param mixed $b
     *
     * @return int
     */
    public function compare($a, $b): int;
}