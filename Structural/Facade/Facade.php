<?php

declare(strict_types=1);

namespace DesignPatterns\Structural\Facade;

class Facade
{
    private SubFlow1 $subFlow1;
    private SubFlow2 $subFlow2;
    private SubFlow3 $subFlow3;

    public function __construct()
    {
        $this->subFlow1 = new SubFlow1();
        $this->subFlow2 = new SubFlow2();
        $this->subFlow3 = new SubFlow3();
    }

    public function prove(): bool
    {
        $isTrue = $this->subFlow1->isTrue();
        $isOk = $this->subFlow2->isOk();
        $isSuccess = $this->subFlow3->isSuccess();

        return $isTrue && $isOk && $isSuccess;
    }
}