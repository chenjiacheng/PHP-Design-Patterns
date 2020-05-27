<?php

namespace FactoryMethod;

/**
 * 减法工厂
 * Class AddFactory
 * @package FactoryMethod
 */
class SubFactory extends Factory
{
    /**
     * 创建减法产品类
     * @return Sub|mixed
     */
    public function create()
    {
        return new Sub();
    }
}