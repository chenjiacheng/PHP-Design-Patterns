<?php

/*

简单工厂模式

结构
1个工厂；
1个 interface 或者 abstract 产品父类；
多个实现 interface 或者继承 abstract 的具体产品类；*/

$factory = new \SimpleFactory\Factory();
$operation = $factory->create('+');
$operation->setNumberA(1);
$operation->setNumberB(2);
$result = $operation->getResult();
echo $result;
