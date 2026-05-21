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

        foreach (self::modules() as $module) {
            foreach (self::crudPermissions() as $action) {
                $permissions[] = "{$module}.{$action}";
            }
        }

        return $permissions;
    }
}
