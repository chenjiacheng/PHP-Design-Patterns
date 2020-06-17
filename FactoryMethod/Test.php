<?php

/*

工厂方法模式

结构
1个 interface 或者 abstract 产品父类；
多个实现 interface 或者继承 abstract 的具体产品类；

1个 interface 或者 abstract 工厂父类；
多个实现 interface 或者继承 abstract 的具体工厂类；

具体工厂类和具体产品类一一对应；
在具体工厂类中实例化具体的产品类*/

$factory = new \FactoryMethod\AddFactory();
$operation = $factory->create();
$operation->setNumberA(1);
$operation->setNumberB(2);
$result = $operation->getResult();
echo $result;