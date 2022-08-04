<?php

declare(strict_types=1);

namespace DesignPatterns\Behavioral\Mediator;

// 具体同事类B
class ConcreteColleagueB extends Colleague
{
    public function receive(): string
    {
        var_dump('具体同时类B收到请求');
        return '具体同时类B收到请求';
    }

    public function send(): string
    {
        $this->mediator->relay(); // 请中介者转发
        var_dump('具体同时类B发出请求');
        return '具体同时类B发出请求';
    }
}