<?php

namespace Singleton;

/**
 * 单例模式
 * Class Db
 * @package Singleton
 */
class Db
{
    /**
     * @var
     */
    private static $instance;

    /**
     * 通过懒加载获得实例
     * @return mixed
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * 防止使用 new 创建多个实例
     */
    private function __construct()
    {
    }

    /**
     * 防止 clone 多个实例
     */
    private function __clone()
    {
    }

    /**
     * 防止反序列化
     */
    private function __wakeup()
    {
    }
}
