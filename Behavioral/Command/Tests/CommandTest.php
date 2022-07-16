<?php


use Behavioral\Command\ChangFenCommand;
use Behavioral\Command\HeFenCommand;
use Behavioral\Command\HunTunCommand;
use Behavioral\Command\WaiterInvoker;
use PHPUnit\Framework\TestCase;

class CommandTest extends TestCase
{
    public function testInvocation()
    {
        // 实例化调用者：服务员
        $waiterInvoker = new WaiterInvoker();

        // 设置早餐菜单
        $waiterInvoker->setChangFen(new ChangFenCommand()); // 设置肠粉
        $waiterInvoker->setHeFen(new HeFenCommand()); // 设置河粉
        $waiterInvoker->setHunTun(new HunTunCommand()); // 设置馄饨

        // 选择早餐
        $this->assertSame($waiterInvoker->chooseChangFen(), '做好了肠粉');
        $this->assertSame($waiterInvoker->chooseHeFen(), '做好了河粉');
        $this->assertSame($waiterInvoker->chooseHunTun(), '做好了馄饨');
    }
}
