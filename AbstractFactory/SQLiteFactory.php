<?php


namespace AbstractFactory;


class SQLiteFactory implements Factory
{

    public function createUser()
    {
        return new SQLiteUser();
    }

    public function createArticle()
    {
        return new SQLiteArticle();
    }
}