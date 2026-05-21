<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Services\PermissionService;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        foreach (PermissionService::generatePermissions() as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }
    }
}