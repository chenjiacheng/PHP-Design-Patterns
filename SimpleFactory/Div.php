<?php

namespace SimpleFactory;

/**
 * 除法
 * Class Add
 * @package SimpleFactory
 */
class Div extends Operation
{
    /**
     * 计算结果
     * @return float|int
     * @throws \Exception
     */
    public function getResult()
    {
        if ($this->numberB == 0) {
            throw new \Exception('除数不能为0');
        }

        return $this->numberA / $this->numberB;
    }
}