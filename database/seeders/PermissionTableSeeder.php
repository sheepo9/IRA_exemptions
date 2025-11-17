<?php

namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
  
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete','operation-list', 'operation-create', 'operation-edit', 'operation-delete',
        'overtime-application-list', 'overtime-application-create', 'overtime-application-edit', 'overtime-application-delete',
        'exemption-application-list', 'exemption-application-create', 'exemption-application-edit', 'exemption-application-delete',
        'exemption-wager-list', 'exemption-wager-create', 'exemption-wager-edit', 'exemption-wager-delete',
        'exemption-variation-list', 'exemption-variation-create', 'exemption-variation-edit', 'exemption-variation-delete',
        'exemption-declaration-list', 'exemption-declaration-create', 'exemption-declaration-edit', 'exemption-declaration-delete',
    
         
        ];
        
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}