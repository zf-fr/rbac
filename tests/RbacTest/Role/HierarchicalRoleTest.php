<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Permissions
 */

namespace RbacTest;

use Rbac\Role\HierarchicalRole;

/**
 * @covers \Rbac\Role\HierarchicalRole
 * @group Coverage
 */
class HierarchicalRoleTest extends \PHPUnit_Framework_TestCase
{
    public function testCanAddChild()
    {
        $role  = new HierarchicalRole('php');
        $child = new HierarchicalRole('ror');
        $role->addChild($child);

        $count = 0;

        foreach ($role as $child) {
            $count++;
        }

        $this->assertEquals(1, $count);
    }

    public function testDontTestChildPermission()
    {
        $role  = new HierarchicalRole('php');
        $child = new HierarchicalRole('ror');

        $role->addChild($role);
        $child->addPermission('debug');

        $this->assertTrue($child->hasPermission('debug'));
        $this->assertFalse($role->hasPermission('debug'));
    }
}
