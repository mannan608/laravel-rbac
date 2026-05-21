<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $manager = Role::firstOrCreate(['name' => 'Manager']);
        $editor = Role::firstOrCreate(['name' => 'Editor']);
        $viewer = Role::firstOrCreate(['name' => 'Viewer']);

        $superAdmin->syncPermissions(Permission::all());

        $manager->syncPermissions([
            'dashboard.view',
            'products.viewAny',
            'products.create',
            'products.edit',
            'products.view',
        ]);

        $editor->syncPermissions([
            'dashboard.view',
            'products.view',
            'products.create',
            'products.edit',
        ]);

        $viewer->syncPermissions([
            'dashboard.view',
            'products.view',
        ]);
    }
}
