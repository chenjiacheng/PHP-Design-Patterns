<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Structural\Composite\Form;
use Structural\Composite\InputElement;
use Structural\Composite\TextElement;

class CompositeTest extends TestCase
{
    public function testRender()
    {
        $form = new Form();
        $form->addElement(new TextElement('Email:'));
        $form->addElement(new InputElement());

        $embed = new Form();
        $embed->addElement(new TextElement('Password:'));
        $embed->addElement(new InputElement());

        $form->addElement($embed);

        // 此代码仅作示例。在实际场景中，现在的网页浏览器根本不支持
        // 多表单嵌套，牢记该点非常重要

        $this->assertEquals('<form>Email:<input type="text" /><form>Password:<input type="text" /></form></form>', $form->render());
    }
}
