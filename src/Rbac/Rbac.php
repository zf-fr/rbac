<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Rbac;

use Rbac\Permission\PermissionInterface;
use Rbac\Role\RoleInterface;
use Rbac\Traversal\Strategy\RecursiveRoleIteratorStrategy;
use Rbac\Traversal\Strategy\TraversalStrategyInterface;
use Traversable;

/**
 * Rbac object. It is used to check a permission against roles
 */
class Rbac
{
    /**
     * @var TraversalStrategyInterface
     */
    protected $traversalStrategy;

    /**
     * @param null|TraversalStrategyInterface $strategy
     */
    public function __construct(TraversalStrategyInterface $strategy = null)
    {
        $this->traversalStrategy = ($strategy) ? $strategy : new RecursiveRoleIteratorStrategy;
    }

    /**
     * Determines if access is granted by checking the roles for permission.
     *
     * @param  RoleInterface|RoleInterface[]|Traversable $roles
     * @param  PermissionInterface|string                $permission
     * @return bool
     */
    public function isGranted($roles, $permission)
    {
        $permission = (string) $permission;

        if ($roles instanceof RoleInterface) {
            $roles = [$roles];
        }

        $iterator = $this->traversalStrategy->traverseRoles($roles);

        foreach ($iterator as $role) {
            /* @var RoleInterface $role */
            if ($role->hasPermission($permission)) {
                return true;
            }
        }

        return false;
    }
}
