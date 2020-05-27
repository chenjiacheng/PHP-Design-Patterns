<?php

namespace FactoryMethod;

/**
 * 除法工厂
 * Class AddFactory
 * @package FactoryMethod
 */
class DivFactory extends Factory
{
    /**
     * 创建除法产品类
     * @return Sub|mixed
     */
    public function create()
    {
        return new Mul();
    }
}