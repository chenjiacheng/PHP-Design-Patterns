<?php

namespace AbstractFactoryWithSimpleFactory;


class Factory
{
    public $db = 'MySQL';

    /**
     * 创建 User 产品
     * @return mixed
     */
    public function createUser()
    {
        switch ($this->db) {
            case 'MySQL':
                $user = new MySQLUser();
                break;
            case 'SQLite':
                $user = new SQLiteUser();
                break;
            default:
                throw new \Exception('暂不支持的数据库类型');
        }

        return $user;
    }

    /**
     * 创建 Article 产品
     * @return mixed
     */
    public function createArticle()
    {
        switch ($this->db) {
            case 'MySQL':
                $article = new MySQLArticle();
                break;
            case 'SQLite':
                $article = new SQLiteArticle();
                break;
            default:
                throw new \Exception('暂不支持的数据库类型');
        }

        return $article;
    }
}