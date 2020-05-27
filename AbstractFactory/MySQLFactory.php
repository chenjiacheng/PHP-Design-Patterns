<?php


namespace AbstractFactory;


class MySQLFactory implements Factory
{

    public function createUser()
    {
        return new MySQLUser();
    }

    public function createArticle()
    {
        return new MySQLArticle();
    }
}