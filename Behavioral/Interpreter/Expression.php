<?php

declare(strict_types=1);

namespace Behavioral\Interpreter;

// 抽象表达式类
interface Expression
{
    public function interpret(string $info): bool;
}