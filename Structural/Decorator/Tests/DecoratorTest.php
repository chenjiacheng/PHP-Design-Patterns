<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use DesignPatterns\Structural\Decorator\JsonRenderer;
use DesignPatterns\Structural\Decorator\Webservice;
use DesignPatterns\Structural\Decorator\XmlRenderer;

/**
 * 创建自动化测试单元 DecoratorTest 。
 */
class DecoratorTest extends TestCase
{
    /**
     * 测试 JSON 装饰者。
     * 这里的 assertEquals 是为了判断返回的结果是否符合预期。
     */
    public function testJsonDecorator()
    {
        $service = new JsonRenderer(new Webservice('foobar'));

        $this->assertEquals('"foobar"', $service->renderData());
    }

    /**
     * 测试 Xml 装饰者。
     */
    public function testXmlDecorator()
    {
        $service = new XmlRenderer(new Webservice('foobar'));

        $this->assertXmlStringEqualsXmlString('<?xml version="1.0"?><content>foobar</content>', $service->renderData());
    }
}
