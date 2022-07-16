<?php


use Behavioral\Mediator\ConcreteColleagueA;
use Behavioral\Mediator\ConcreteColleagueB;
use Behavioral\Mediator\ConcreteMediator;
use PHPUnit\Framework\TestCase;

class MediatorTest extends TestCase
{
    public function testReceive()
    {
        $mediator = new ConcreteMediator();

        $colleagueA = new ConcreteColleagueA();
        $colleagueB = new ConcreteColleagueB();

        $mediator->register($colleagueA);
        $mediator->register($colleagueB);

        $colleagueA->send();
        var_dump('----------------------');
        $colleagueB->send();

        $this->assertIsBool(true);
    }
}
