<?php

declare(strict_types=1);

namespace Structural\Proxy;

/**
 * 抽象主题
 */
interface Subject
{
    public function request();
}