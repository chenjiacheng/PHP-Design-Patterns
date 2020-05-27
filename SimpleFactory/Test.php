<?php

$factory = new \SimpleFactory\Factory();
$operation = $factory->create('+');
$operation->setNumberA(1);
$operation->setNumberB(2);
$result = $operation->getResult();
echo $result;
