<?php

declare(strict_types=1);

use Behavioral\Visitor\RoleVisitor;
use Behavioral\Visitor\User;
use Behavioral\Visitor\Group;
use PHPUnit\Framework\TestCase;

class VisitorTest extends TestCase
{
    public function testUserRole()
    {
        $roleVisitor = new RoleVisitor();

        $user = new User('Dominik');
        $user->accept($roleVisitor);
        $this->assertSame($user, $roleVisitor->getVisited()[0]);
    }

    public function testGroupRole()
    {
        $roleVisitor = new RoleVisitor();

        $group = new Group('Administrators');
        $group->accept($roleVisitor);
        $this->assertSame($group, $roleVisitor->getVisited()[0]);
    }
}
