<?php

declare(strict_types=1);

namespace Behavioral\ChainOfResponsibilities;

/**
 * 领导抽象类
 */
abstract class Leader
{
    private Leader $next;

    public function setNext(Leader $next): Leader
    {
        $this->next = $next;
        return $this;
    }

    public function getNext(): Leader
    {
        return $this->next;
    }

    abstract public function handleRequest(int $leaveDays);
}