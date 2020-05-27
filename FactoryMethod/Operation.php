<?php

namespace FactoryMethod;

abstract class Operation
{
    /**
     * 运算符号左边的值
     * @var int
     */
    protected $numberA = 0;

    /**
     * 运算符号右边的值
     * @var int
     */
    protected $numberB = 0;

    abstract public function getResult();

    /**
     * @param int $numberA
     * @return void
     */
    public function setNumberA($numberA)
    {
        $this->numberA = $numberA;
    }

    /**
     * @param int $numberB
     * @return void
     */
    public function setNumberB($numberB)
    {
        $this->numberB = $numberB;
    }
}