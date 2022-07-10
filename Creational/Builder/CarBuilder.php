<?php

declare(strict_types=1);

namespace Creational\Builder;

use Creational\Builder\Parts\Car;
use Creational\Builder\Parts\Door;
use Creational\Builder\Parts\Engine;
use Creational\Builder\Parts\Vehicle;
use Creational\Builder\Parts\Wheel;

class CarBuilder implements Builder
{
    private Car $car;

    public function addDoors()
    {
        $this->car->setPart('rightDoor', new Door());
        $this->car->setPart('leftDoor', new Door());
        $this->car->setPart('trunkLid', new Door());
    }

    public function addEngine()
    {
        $this->car->setPart('engine', new Engine());
    }

    public function addWheel()
    {
        $this->car->setPart('wheelLF', new Wheel());
        $this->car->setPart('wheelRF', new Wheel());
        $this->car->setPart('wheelLR', new Wheel());
        $this->car->setPart('wheelRR', new Wheel());
    }

    public function createVehicle()
    {
        $this->car = new Car();
    }

    public function getVehicle(): Vehicle
    {
        return $this->car;
    }
}