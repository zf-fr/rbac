<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Rbac\Permission;

/**
 * Interface for permission
 */
interface PermissionInterface
{
    /**
     * Get the permission name
     *
     * @return string|int
     */
    public function getName();

    /**
     * Cast the permission to a string (must return the permission name)
     *
     * @return string
     */
    public function __toString();
}
