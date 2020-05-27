<?php

namespace SimpleFactory;

/**
 * 减法
 * Class Add
 * @package SimpleFactory
 */
class Sub extends Operation
{
    /**
     * 计算结果
     * @return int
     */
    public function getResult()
    {
        return $this->numberA - $this->numberB;
    }
}