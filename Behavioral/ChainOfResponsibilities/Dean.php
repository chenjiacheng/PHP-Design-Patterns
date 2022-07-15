<?php

declare(strict_types=1);

namespace Behavioral\ChainOfResponsibilities;

/**
 * 院长类
 */
class Dean extends Leader
{
    public function handleRequest(int $leaveDays): string
    {
        if ($leaveDays <= 10) {
            return "院长批准请假{$leaveDays}天";
        } else {
            if ($this->getNext() !== null) {
                return $this->getNext()->handleRequest($leaveDays);
            } else {
                return "请假天数太多，没有人批准该假条";
            }
        }
    }
}