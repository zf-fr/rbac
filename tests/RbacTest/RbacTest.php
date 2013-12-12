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

use Rbac\Rbac;
use Rbac\Role\HierarchicalRole;
use Rbac\Role\Role;

/**
 * @covers Rbac\Rbac
 * @group Coverage
 */
class RbacTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Rbac
     */
    protected $rbac;

    public function setUp()
    {
        $this->rbac = new Rbac();
    }

    public function testCanGrantAccessWithFlatRole()
    {
        $role = new Role('foo');

        $role->addPermission('debug');

        $this->assertTrue($this->rbac->isGranted($role, 'debug'));
        $this->assertFalse($this->rbac->isGranted($role, 'fix'));
    }

    public function testCanGrantAccessWithHierarchicalRole()
    {
        $role       = new HierarchicalRole('foo');
        $subRole    = new HierarchicalRole('bar');
        $subSubRole = new HierarchicalRole('baz');

        $role->addChild($subRole);
        $subRole->addChild($subSubRole);

        $subRole->addPermission('debug');

        $this->assertTrue($this->rbac->isGranted($role, 'debug'), 'Inherit permission from its children');
        $this->assertTrue($this->rbac->isGranted($subRole, 'debug'), 'Have its own permission');
        $this->assertFalse($this->rbac->isGranted($subSubRole, 'debug'), 'Does not have permission from its parent');
    }
}
