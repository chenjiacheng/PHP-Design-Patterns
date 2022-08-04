<?php

declare(strict_types=1);

namespace DesignPatterns\Behavioral\Command;

// 抽象命令：早餐
interface BreakfastCommand
{
    /**
     * 这是在命令行模式中很重要的方法，
     * 这个接收者会被载入构造器
     */
    public function execute();
}