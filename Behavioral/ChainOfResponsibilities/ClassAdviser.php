<?php

declare(strict_types=1);

namespace Behavioral\ChainOfResponsibilities;

/**
 * 班主任类
 */
class ClassAdviser extends Leader
{
    public function handleRequest(int $leaveDays): string
    {
        if ($leaveDays <= 2) {
            return "班主任批准请假{$leaveDays}天";
        } else {
            if ($this->getNext() !== null) {
                return $this->getNext()->handleRequest($leaveDays);
            } else {
                return "请假天数太多，没有人批准该假条";
            }
        }
    }
}