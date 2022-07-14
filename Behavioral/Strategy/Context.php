<?php

declare(strict_types=1);

namespace Behavioral\Strategy;

class Context
{
    /**
     * @var ComparatorInterface
     */
    private ComparatorInterface $comparator;

    public function __construct(ComparatorInterface $comparator)
    {
        $this->comparator = $comparator;
    }

    public function executeStrategy(array $elements): array
    {
        uasort($elements, [$this->comparator, 'compare']);

        return $elements;
    }
}