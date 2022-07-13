<?php

declare(strict_types=1);

namespace Structural\Composite;

interface RenderableInterface
{
    public function render(): string;
}