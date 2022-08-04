<?php

declare(strict_types=1);

use DesignPatterns\Behavioral\ChainOfResponsibilities\ClassAdviser;
use DesignPatterns\Behavioral\ChainOfResponsibilities\Dean;
use DesignPatterns\Behavioral\ChainOfResponsibilities\DepartmentHead;
use PHPUnit\Framework\TestCase;

class ChainTest extends TestCase
{
    public function testLeaveDays()
    {
        $teacher1 = new ClassAdviser();
        $teacher2 = new DepartmentHead();
        $teacher3 = new Dean();

        $teacher1->setNext($teacher2);
        $teacher2->setNext($teacher3);

        $leaveDays = 8;
        if ($leaveDays <= 2) {
            $result = "班主任批准请假{$leaveDays}天";
        } elseif ($leaveDays <= 7) {
            $result = "系主任批准请假{$leaveDays}天";
        } elseif ($leaveDays <= 10) {
            $result = "院长批准请假{$leaveDays}天";
        } else {
            $result = "请假天数太多，没有人批准该假条";
        }
        $this->assertSame($teacher1->handleRequest($leaveDays), $result);
    }
}
