<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $judul = [
            'Dashboard Staff', 'Dashboard Admin', 'Dashboard HRD',
            'Riwayat Pengajuan Cuti', 'Pengajuan Cuti', 'Buat Pengajuan Cuti',
            'Pengajuan Cuti Pegawai', 'Manajemen Role & Menu', 'Kebijakan Cuti & Jam Kantor',
            'Data Pegawai', 'Data Jabatan', 'List Data Jabatan',
            'Data Riwayat Jabatan', 'Data Divisi', 'List Data Divisi',
            'Data Riwayat Divisi', 'Data Presensi', 'List Data Presensi',
            'Rekapan Data Presensi Pegawai', 'Data Cuti', 'List Data Cuti',
            'Atur Tanggal Cuti Bersama', 'Rekapan Data Cuti Pegawai',
        ];

        $parent = [
            null, null, null,
            null, null, 5,
            5, null, null,
            null, null, 11,
            11, null, 14,
            14, null, 17,
            17, null, 20,
            20, 20,
        ];

        $url = [
            'staff', 'superAdmin', 'hrd',
            'staffCuti', null, 'staffCuti/create',
            'staffPengajuanCuti', 'manajemen', 'peraturan',
            'pegawai', null, 'jabatan',
            'riwayatJabatan', null, 'divisi',
            'riwayatDivisi', null, 'presensi',
            'rekapPresensi', null, 'cuti',
            'cuti/cutiBersama', 'rekapCuti',
        ];

        $icon = [
            'icon-rocket', 'icon-rocket', 'icon-rocket',
            'icon-history', 'icon-furniture', null,
            null, 'icon-key', 'icon-info3',
            'icon-users', 'icon-user-tie', null,
            null, 'icon-hat', null,
            null, 'icon-notebook', null,
            null, 'icon-furniture', null,
            null, null,

        ];

        $id_hak_akses = [
            2, 9, 10,
            2, 2, 2,
            2, 1, 5,
            6, 4, 4,
            4, 3, 3,
            3, 7, 7,
            7, 8, 8,
            8, 8
        ];

        $num = count($judul);

        for ($i = 0; $i < $num; $i++) {
            Menu::create([
                'id_parent' => $parent[$i],
                'judul' => $judul[$i],
                'url' => $url[$i],
                'icon' => $icon[$i],
                'id_hak_akses' => $id_hak_akses[$i],
                'order' => $i,
            ]);
        }
    }
}
