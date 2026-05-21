<?php

namespace App\Services;

class PermissionService
{
    public static function modules(): array
    {
        return [
            'dashboard',
            'users',
            'roles',
            'permissions',
            'products',
        ];
    }

    public static function modulePermissions(): array
    {
        return [
            'dashboard' => ['viewAny', 'view'],
            'users' => self::crudPermissions(),
            'roles' => self::crudPermissions(),
            'permissions' => self::crudPermissions(),
            'products' => self::crudPermissions(),
        ];
    }

    public static function crudPermissions(): array
    {
        return [
            'viewAny',
            'view',
            'create',
            'edit',
            'delete',
        ];
    }

    public static function generatePermissions(): array
    {
        $permissions = [];

        foreach (self::modulePermissions() as $module => $actions) {
            foreach ($actions as $action) {
                $permissions[] = "{$module}.{$action}";
            }
        }

        return $permissions;
    }
}
