<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Rbac;

use Generator;
use Rbac\Role\HierarchicalRoleInterface;
use Rbac\Role\RoleInterface;
use Traversable;

/**
 * Rbac object. It is used to check a permission against roles
 */
class Rbac
{
    /**
     * Determines if access is granted by checking the roles for permission.
     *
     * @param  RoleInterface|RoleInterface[]|Traversable $roles
     * @param  mixed                                     $permission
     * @return bool
     */
    public function isGranted($roles, $permission)
    {
        if ($roles instanceof RoleInterface) {
            $roles = [$roles];
        }

        foreach ($this->getRolesIterator($roles) as $role) {
            /* @var RoleInterface $role */
            if ($role->hasPermission($permission)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param  RoleInterface|RoleInterface[]|Traversable $roles
     * @return Generator
     */
    protected function getRolesIterator($roles)
    {
        foreach ($roles as $role) {
            yield $role;

            if (!$role instanceof HierarchicalRoleInterface) {
                continue;
            }

            $children = $this->getRolesIterator($role->getChildren());

            foreach ($children as $child) {
                yield $child;
            }
        }
    }
}
