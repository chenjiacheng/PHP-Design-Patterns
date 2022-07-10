<?php

declare(strict_types=1);

namespace Creational\Builder;

use Creational\Builder\Parts\Vehicle;

interface Builder
{
    public function createVehicle();

    public function addWheel();

    public function addEngine();

    public function addDoors();

    public function getVehicle(): Vehicle;
}