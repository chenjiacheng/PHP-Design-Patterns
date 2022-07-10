<?php

declare(strict_types=1);

namespace Structural\Adapter;

class Book implements BookInterface
{
    private int $page;

    public function turnPage()
    {
        $this->page++;
    }

    public function open()
    {
        $this->page = 1;
    }

    public function getPage(): int
    {
        return $this->page;
    }
}