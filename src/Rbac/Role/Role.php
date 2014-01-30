<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Rbac\Role;

use InvalidArgumentException;
use Rbac\Permission\PermissionInterface;

/**
 * Simple implementation for a role without hierarchy
 * and using strings as permissions
 */
class Role implements RoleInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string[]
     */
    protected $permissions = [];

    /**
     * Constructor
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = (string) $name;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add a permission
     *
     * @param  PermissionInterface|string $permission
     * @throws InvalidArgumentException
     */
    public function addPermission($permission)
    {
        if (!is_string($permission)) {
            throw new InvalidArgumentException("Permission should be a string");
        }
        $this->permissions[(string) $permission] = $permission;
    }

    /**
     * Checks if a permission exists for this role
     *
     * @param  string $permission
     * @throws InvalidArgumentException
     * @return bool
     */
    public function hasPermission($permission)
    {
        if (!is_string($permission)) {
            throw new InvalidArgumentException("Permission should be a string");
        }
        return isset($this->permissions[(string) $permission]);
    }
}
