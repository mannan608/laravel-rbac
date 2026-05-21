<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
            'products.viewAny',
            'products.create',
            'products.edit',
            'products.view',
        ]);

        $viewer->syncPermissions([
            'products.viewAny',
            'products.view',
        ]);
    }
}