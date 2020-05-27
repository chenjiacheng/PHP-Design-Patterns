<?php

namespace FactoryMethod;

/**
 * 加法工厂
 * Class AddFactory
 * @package FactoryMethod
 */
class AddFactory extends Factory
{
    /**
     * 创建加法产品类
     * @return Add|mixed
     */
    public function create()
    {
        return new Add();
    }
}