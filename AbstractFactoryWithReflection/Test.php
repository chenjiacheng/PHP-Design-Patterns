<?php

/*

使用反射来优化抽象工厂模式

结构
多个 interface 或者 abstract 产品父类；
多个实现 interface 或者继承 abstract 的具体产品类；

1个工厂；
工厂类里面有多个方法分别实例化不同的具体产品类；*/

$factory = new \AbstractFactoryWithReflection\Factory();

$user = $factory->createUser();
$user->insert();
$user->select();

$article = $factory->createArticle();
$article->insert();
$article->select();


