<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Rbac\Role;

use RecursiveIterator;

/**
 * Simple implementation for a hierarchical role
 */
class HierarchicalRole extends Role implements HierarchicalRoleInterface
{
    /**
     * {@see RecursiveIterator} implementation
     */
    use RecursiveIteratorTrait;

    /**
     * @var array|RoleInterface[]
     */
    protected $children = [];

    /**
     * {@inheritDoc}
     */
    public function addChild(RoleInterface $child)
    {
        $this->children[] = $child;
    }
}
