<?php

declare(strict_types=1);

namespace Structural\Proxy\Tests;

use PHPUnit\Framework\TestCase;
use Structural\Proxy\SubjectOneProxy;
use Structural\Proxy\SubjectTwoProxy;

class ProxyTest extends TestCase
{
    public function testSubjectProxy()
    {
        $subjectProxy = new SubjectOneProxy();
        $subjectProxy->request();
        /*输出结果：
        string(48) "主题一访问真实主题之前的预处理。"
        string(24) "访问真是主题方法"
        string(51) "主题一访问真实主题之前的后续处理。""*/

        $subjectProxy = new SubjectTwoProxy();
        $subjectProxy->request();
        /*输出结果：
        string(48) "主题二访问真实主题之前的预处理。"
        string(24) "访问真是主题方法"
        string(51) "主题二访问真实主题之前的后续处理。""*/
    }
}
