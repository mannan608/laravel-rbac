<?php

namespace Database\Seeders;

use App\Services\PermissionService;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = PermissionService::generatePermissions();

        Permission::whereIn('name', $this->managedPermissionNames())
            ->whereNotIn('name', $permissions)
            ->delete();

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }

    private function managedPermissionNames(): array
    {
        $permissions = [];

        foreach (PermissionService::modules() as $module) {
            foreach (PermissionService::crudPermissions() as $action) {
                $permissions[] = "{$module}.{$action}";
            }
        }

        return $permissions;
    }
}
