<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $roles = [
            'Deputy_Director',
            'Executive_Director',
            'Deputy_Executive_Director',
            'Minister',
            'Administrator',
            'User',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['name' => $role]
            );
        }
    }
}
