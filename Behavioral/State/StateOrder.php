<?php

declare(strict_types=1);

namespace Behavioral\State;

/**
 * 抽象状态类
 */
abstract class StateOrder
{
    /**
     * @var array
     */
    private array $details;

    /**
     * @var StateOrder $state
     */
    protected static $state;

    /**
     * @return mixed
     */
    abstract protected function done();

    protected function setStatus(string $status)
    {
        $this->details['status'] = $status;
        $this->details['updatedTime'] = time();
    }

    protected function getStatus(): string
    {
        return $this->details['status'];
    }
}
