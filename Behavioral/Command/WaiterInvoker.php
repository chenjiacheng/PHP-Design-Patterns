<?php

declare(strict_types=1);

namespace Behavioral\Command;

// 调用者：服务员
class WaiterInvoker
{
    protected BreakfastCommand $changFenCommand;
    protected BreakfastCommand $heFenCommand;
    protected BreakfastCommand $hunTunCommand;

    public function setChangFen(BreakfastCommand $command)
    {
        $this->changFenCommand = $command;
    }

    public function setHeFen(BreakfastCommand $command)
    {
        $this->heFenCommand = $command;
    }

    public function setHunTun(BreakfastCommand $command)
    {
        $this->hunTunCommand = $command;
    }

    public function chooseChangFen()
    {
        return $this->changFenCommand->execute();
    }

    public function chooseHeFen()
    {
        return $this->heFenCommand->execute();
    }

    public function chooseHunTun()
    {
        return $this->hunTunCommand->execute();
    }
}