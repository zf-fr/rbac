<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Rbac\Role;

use Rbac\Permission\PermissionInterface;

/**
 * Simple implementation for a role
 */
class Role implements RoleInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var array|PermissionInterface
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
     * {@inheritDoc}
     */
    public function addPermission($permission)
    {
        $this->permissions[(string) $permission] = $permission;
    }

    /**
     * {@inheritDoc}
     */
    public function hasPermission($permission)
    {
        return isset($this->permissions[(string) $permission]);
    }
}
