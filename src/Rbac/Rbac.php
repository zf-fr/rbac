<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Rbac;

use Rbac\Identity\IdentityInterface;
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
     * Determines if access is granted by checking the identity roles for permission.
     *
     * @param  IdentityInterface          $identity
     * @param  PermissionInterface|string $permission
     * @return bool
     */
    public function isGranted(IdentityInterface $identity, $permission)
    {
        $permission = (string) $permission;
        $roles      = $identity->getRoles();

        foreach ($roles as $role) {
            // First check directly the role
            if ($role->hasPermission($permission)) {
                return true;
            }

            // Otherwise, we recursively check each children only if it's a hierarchical role
            if (!$role instanceof HierarchicalRoleInterface) {
                continue;
            }

            $iteratorIterator = new RecursiveIteratorIterator($role, RecursiveIteratorIterator::SELF_FIRST);

            foreach ($iteratorIterator as $child) {
                /** @var RoleInterface $child */
                if ($child->hasPermission($permission)) {
                    return true;
                }
            }
        }

        return false;
    }
}
