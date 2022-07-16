<?php

declare(strict_types=1);

namespace Behavioral\Mediator;

// 抽象中介者
abstract class Mediator
{
    abstract public function register(Colleague $colleague); // 注册

    abstract public function relay(); // 转发
}