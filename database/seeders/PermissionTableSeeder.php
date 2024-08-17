<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Schema;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',

           'user-profile',
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
           'user-details-update',

           'working-locations-list',
           'working-locations-create',
           'working-locations-edit',
           'working-locations-delete',

           'assigne-project-list',
           // 'assigne-project-create',
           'assigne-project-edit',
           // 'assigne-project-delete',
        
            'attendance-list',
            'attendance-create',
            'attendance-edit',
            'attendance-delete',
            
            'user-request-product',
            'user-request-leave',
            'user-request-fund',
            
            'attendance-report',
            
            'leave-edit',
            'leave-delete',
            
            'product-request-edit',
            'product-request-delete',
            
            'fund-request-edit',
            'fund-request-delete',
            
            'lead-create',
            'lead-list',
            'lead-edit',
            'lead-delete',

        ];
        
     
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
