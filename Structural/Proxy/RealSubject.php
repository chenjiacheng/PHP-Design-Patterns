<?php

declare(strict_types=1);

namespace DesignPatterns\Structural\Proxy;

/**
 * 真实主题
 */
class RealSubject implements Subject
{
    public function request()
    {
        var_dump('访问真是主题方法');
    }
}