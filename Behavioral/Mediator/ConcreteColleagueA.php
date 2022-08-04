<?php

declare(strict_types=1);

namespace DesignPatterns\Behavioral\Mediator;

// 具体同事类A
class ConcreteColleagueA extends Colleague
{
    public function receive(): string
    {
        var_dump('具体同时类A收到请求');
        return '具体同时类A收到请求';
    }

    public function send(): string
    {
        var_dump('具体同时类A发出请求');
        $this->mediator->relay(); // 请中介者转发
        return '具体同时类A发出请求';
    }
}