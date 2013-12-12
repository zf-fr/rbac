<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Rbac;

use Rbac\Permission\PermissionInterface;
use Rbac\Role\HierarchicalRoleInterface;
use Rbac\Role\RoleInterface;
use RecursiveIteratorIterator;

/**
 * Rbac object. It is used to check a permission against a role
 */
class Rbac
{
    /**
     * Determines if access is granted by checking the role and child roles for permission.
     *
     * @param  RoleInterface              $role
     * @param  PermissionInterface|string $permission
     * @return bool
     */
    public function isGranted(RoleInterface $role, $permission)
    {
        $permission = (string) $permission;

        // First check directly the role
        if ($role->hasPermission($permission)) {
            return true;
        }

        // Otherwise, we recursively check each children only if it's a hierarchical role
        if (!$role instanceof HierarchicalRoleInterface) {
            return false;
        }

        $iteratorIterator = new RecursiveIteratorIterator($role, RecursiveIteratorIterator::SELF_FIRST);

        foreach ($iteratorIterator as $child) {
            /** @var RoleInterface $child */
            if ($child->hasPermission($permission)) {
                return true;
            }
        }

        return false;
    }
}
