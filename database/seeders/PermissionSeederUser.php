<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionSeederUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           // List all permissions
        $permissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
