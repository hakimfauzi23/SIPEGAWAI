<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = Role::create([
            'name' => 'ADMIN',
            'guard_name' => 'web'
        ]);
        $hrd = Role::create([
            'name' => 'HRD',
            'guard_name' => 'web'
        ]);
        $staff = Role::create([
            'name' => 'STAFF',
            'guard_name' => 'web'
        ]);

        $permissions = Permission::pluck('id', 'id')->all();
        $admin->syncPermissions($permissions);
        $hrd->syncPermissions([2, 5, 6, 7, 8, 10, 11, 12]);
        $staff->syncPermissions([2]);
    }
}
