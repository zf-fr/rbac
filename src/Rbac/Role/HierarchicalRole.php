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
     * @var array|RoleInterface[]
     */
    protected $children = [];

    /**
     * @var int
     */
    protected $index = 0;

    /**
     * {@inheritDoc}
     */
    public function addChild(RoleInterface $child)
    {
        $this->children[] = $child;
    }

    /*
     * --------------------------------------------------------------------------------
     * RecursiveIterator implementation
     * --------------------------------------------------------------------------------
     */

    /**
     * {@inheritDoc}
     */
    public function current()
    {
        return $this->children[$this->index];
    }

    /**
     * {@inheritDoc}
     */
    public function next()
    {
        $this->index++;
    }

    /**
     * {@inheritDoc}
     */
    public function key()
    {
        return $this->index;
    }

    /**
     * {@inheritDoc}
     */
    public function valid()
    {
        return isset($this->children[$this->index]);
    }

    /**
     * {@inheritDoc}
     */
    public function rewind()
    {
        $this->index = 0;
    }

    /**
     * {@inheritDoc}
     */
    public function getChildren()
    {
        return $this->children[$this->index];
    }

    /**
     * {@inheritDoc}
     */
    public function hasChildren()
    {
        return $this->valid() && $this->current() instanceof RecursiveIterator;
    }
}
