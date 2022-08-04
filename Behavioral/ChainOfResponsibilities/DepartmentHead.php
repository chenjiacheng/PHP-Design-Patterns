<?php

declare(strict_types=1);

namespace DesignPatterns\Behavioral\ChainOfResponsibilities;

/**
 * 系主任类
 */
class DepartmentHead extends Leader
{
    public function handleRequest(int $leaveDays): string
    {
        if ($leaveDays <= 7) {
            return "系主任批准请假{$leaveDays}天";
        } else {
            if ($this->getNext() !== null) {
                return $this->getNext()->handleRequest($leaveDays);
            } else {
                return "请假天数太多，没有人批准该假条";
            }
        }
    }
}