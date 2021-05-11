<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

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
            'manajemen-role',
            'menu-staff',
            'menu-divisi',
            'menu-jabatan',
            'menu-kebijakan-kantor',
            'menu-pegawai',
            'menu-presensi',
            'menu-cuti',
            'dashboard-admin',
            'dashboard-hrd',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
