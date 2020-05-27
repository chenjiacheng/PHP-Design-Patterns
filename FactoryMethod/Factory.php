<?php

namespace FactoryMethod;

abstract class Factory
{
    /**
     * 创建产品
     * @return mixed
     */
    abstract public function create();
}