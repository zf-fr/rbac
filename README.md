Rbac
====

[![Build Status](https://travis-ci.org/zf-fr/rbac.png)](https://travis-ci.org/zf-fr/rbac)
[![Latest Stable Version](https://poser.pugx.org/zfr/rbac/v/stable.png)](https://packagist.org/packages/zfr/rbac)
[![Total Downloads](https://poser.pugx.org/zfr/rbac/downloads.png)](https://packagist.org/packages/zfr/rbac)

Rbac (not to be confused with ZfcRbac) is a pure PHP implementation of the RBAC (*Role based access control*)
concept. Actually, it is a Zend Framework 3 prototype of the ZF2 Zend\Permissions\Rbac component.

It aims to fix some design mistakes that were made to make it more usable and more efficient.

It differs on those points:

* A `PermissionInterface` has been introduced.
* The `RoleInterface` has new `removeChild` and `removePermission` methods.
* `RoleInterface` no longer have `setParent` and `getParent` methods. Instead, roles should have a ManyToMany
association to its children.
* Method `hasPermission` on a role no longer recursively iterate the children role, but only check its own role. To
properly check if a role is granted, you should use the `isGranted` method of the `Rbac` class.
* `Rbac` class is no longer a container. Instead, it just has a `isGranted` method. The container was complex to
properly handle because of role duplication, which could lead to security problems if not used correctly.

This library is used in ZfcRbac 2.0
