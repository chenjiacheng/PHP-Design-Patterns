<?php

declare(strict_types=1);

namespace DesignPatterns\Behavioral\Interpreter;

// 终结符表达式类
class TerminalExpression implements Expression
{
    protected array $list = [];

    public function __construct(array $data = [])
    {
        for ($i = 0; $i < count($data); $i++) {
            $this->list[] = $data[$i];
        }
    }

    public function interpret(string $info): bool
    {
        if (in_array($info, $this->list)) {
            return true;
        }

        return false;
    }
}