<?php

namespace AbstractFactory;

/**
 * Article 产品接口
 * Interface User
 * @package AbstractFactory
 */
interface Article
{
    /**
     * 新增
     * @return mixed
     */
    public function insert();

    /**
     * 查询
     * @return mixed
     */
    public function select();
}