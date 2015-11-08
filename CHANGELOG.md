# CHANGELOG

## 2.0.0

* [BC] Minimum PHP dependency has been raised to 5.5.
* [BC] `PermissionInterface` has been removed from RBAC component. This has been moved to ZfcRbac. Rbac only accepts "mixed"
permission, and it is up to your implementation to decide what a permission is.
* [BC] Rbac will now throw an exception if permission is not a string. If you need to do more check, you could use assertions for instance.

## 1.2.0

* `isGranted` no longer cast permissions to string. Instead, the permission is now given to your role entity as it. This
may be a potential BC if you only expected string in your `hasPermission` method.
* `PermissionInterface` is deprecated and will be removed in final implementation (likely for ZF3). RBAC should not
enforce any interface for a permission as its representation is dependant of your application. However, modules
like ZfcRbac may enforce an interface for permissions.
* Various PHPDoc fixes

## 1.1.0

* [BC] Remove factory. It was not intend to be here but rather on ZfcRbac. This way this component is completely
framework agnostic

## 1.0.0

* Initial release
