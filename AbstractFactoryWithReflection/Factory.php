<?php

namespace AbstractFactoryWithReflection;

/**
 * Class Factory
 * @package AbstractFactoryWithReflection
 */
class Factory
{
    public $db = 'MySQL';

    public $namespace = 'AbstractFactoryWithReflection\\';

    /**
     * 创建 User 产品
     * @return mixed
     */
    public function createUser()
    {
        $className = $this->namespace . $this->db . 'User';

        try {
            $class = new \ReflectionClass($className);
            $user = $class->newInstance();
        } catch (\ReflectionException $exception) {
            throw new \InvalidArgumentException('暂不支持的数据库类型');
        }

        return $user;
    }

    /**
     * 创建 Article 产品
     * @return mixed
     */
    public function createArticle()
    {
        $className = $this->namespace . $this->db . 'Article';

        try {
            $class = new \ReflectionClass($className);
            $article = $class->newInstance();
        } catch (\ReflectionException $exception) {
            throw new \InvalidArgumentException('暂不支持的数据库类型');
        }

        return $article;
    }
}