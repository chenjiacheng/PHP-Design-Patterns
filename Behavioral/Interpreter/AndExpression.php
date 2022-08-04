<?php

declare(strict_types=1);

namespace DesignPatterns\Behavioral\Interpreter;

// 非终结符表达式类
class AndExpression implements Expression
{
    protected Expression $city;
    protected Expression $person;

    public function __construct(Expression $city, Expression $person)
    {
        $this->city = $city;
        $this->person = $person;
    }

    public function interpret(string $info): bool
    {
        $str = explode('的', $info);

        return $this->city->interpret($str[0]) && $this->person->interpret($str[1]);
    }
}