<?php

declare(strict_types=1);

namespace Behavioral\Memento;

/**
 * 备忘录角色
 */
class Memento
{
    /**
     * @var State
     */
    private State $state;

    /**
     * @param State $stateToSave
     */
    public function __construct(State $stateToSave)
    {
        $this->state = $stateToSave;
    }

    /**
     * @return State
     */
    public function getState(): State
    {
        return $this->state;
    }
}