<?php

/*

抽象工厂模式

结构
多个 interface 或者 abstract 产品父类；
多个实现 interface 或者继承 abstract 的具体产品类；

1个 interface 或者 abstract 工厂父类；
1个实现 interface 或者继承 abstract 的具体工厂类；

具体的工厂类里面有多个方法分别实例化具体的产品类；*/

$factory = new \AbstractFactory\MySQLFactory();
$user = $factory->createUser();
$user->insert();
$user->select();

$article = $factory->createArticle();
$article->insert();
$article->select();


$factory1 = new \AbstractFactory\SQLiteFactory();
$user1 = $factory1->createUser();
$user1->insert();
$user1->select();

$article1 = $factory1->createArticle();
$article1->insert();
$article1->select();
