<?php

declare(strict_types=1);

namespace DesignPatterns\Behavioral\Interpreter;

// 环境类
class Context
{
    protected array $citys = ['深圳', '广州'];
    protected array $persons = ['老人', '妇女', '儿童'];
    protected Expression $cityPerson;

    public function __construct()
    {
        $city = new TerminalExpression($this->citys);
        $person = new TerminalExpression($this->persons);
        $this->cityPerson = new AndExpression($city, $person);
    }

    public function freeRide(string $info): string
    {
        $ok = $this->cityPerson->interpret($info);
        if ($ok) {
            return '本次乘车免费';
        } else {
            return '本次乘车扣费2元';
        }
    }
}