<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * 创建自动化测试单元 FacadeTest 。
 */
class FacadeTest extends TestCase
{
    public function testComputerOn()
    {
        $facade = new DesignPatterns\Structural\Facade\Facade();
        $bool = $facade->prove();

        $this->assertTrue($bool);
    }
}
