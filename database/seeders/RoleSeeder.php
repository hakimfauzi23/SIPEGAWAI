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

        // 'dashboard-admin' = 1
        // 'dashboard-hrd'= 2
        // 'menu-staff'= 3
        // 'manajemen-role'= 4
        // 'menu-kebijakan-kantor' = 5
        // 'menu-pegawai'= 6
        // 'menu-jabatan'= 7
        // 'menu-divisi' = 8
        // 'menu-presensi'= 9
        // 'menu-cuti', = 10
        // 'menu-gaji', = 11
        // 'menu-surat-peringatan' = 12
        // 'menu-export-kinerja', =13

        $permissions = Permission::where('id', '!=', 2)->pluck('id', 'id');
        $admin->syncPermissions($permissions);
        $hrd->syncPermissions([
            2, 3, 6, 9, 10, 11, 12, 13
        ]);
        $staff->syncPermissions([
            3
        ]);
    }
}
