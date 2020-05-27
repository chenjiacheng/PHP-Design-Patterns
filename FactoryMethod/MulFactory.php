<?php

namespace FactoryMethod;

/**
 * 乘法工厂
 * Class AddFactory
 * @package FactoryMethod
 */
class MulFactory extends Factory
{
    /**
     * 创建乘法产品类
     * @return Sub|mixed
     */
    public function create()
    {
        return new Mul();
    }
}