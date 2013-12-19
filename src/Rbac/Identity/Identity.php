<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Rbac\Identity;

use Rbac\Role\RoleInterface;

/**
 * Simple implementation for a identity
 */
class Identity implements IdentityInterface
{
    /**
     * @var RoleInterface[]
     */
    protected $roles = [];

    /**
     * Constructor
     *
     * @param null|RoleInterface[] $roles
     */
    public function __construct($roles = null)
    {
        if (null !== $roles) {
            foreach ($roles as $role) {
                $this->addRole($role);
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param RoleInterface $role
     */
    public function addRole(RoleInterface $role)
    {
        $this->roles[$role->getName()] = $role;
    }

    /**
     * @param  RoleInterface $role
     * @return bool
     */
    public function hasRole(RoleInterface $role)
    {
        return isset($this->roles[$role->getName()]);
    }
}
