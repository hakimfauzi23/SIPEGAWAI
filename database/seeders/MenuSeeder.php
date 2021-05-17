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
            'Dashboard Admin', 'Dashboard HRD', 'Menu Staff',
            'Dashboard Staff', 'Riwayat Pengajuan Cuti', ' Pengajuan Cuti',
            'Buat Pengajuan Cuti', 'Pengajuan Cuti Pegawai', 'Manajemen Role & Menu',
            'Kebijakan Cuti & Jam Kantor', 'Data Pegawai', 'Data Jabatan',
            'List Data Jabatan', 'Data Riwayat Jabatan', 'Data Divisi',
            'List Data Divisi', 'Data Riwayat Divisi', 'Data Presensi',
            'List Data Presensi', 'Rekapan Data Presensi Pegawai', 'Data Cuti',
            'List Data Cuti', 'Atur Tanggal Cuti Bersama', 'Rekapan Data Cuti Pegawai',
            'Data Gaji', 'Surat Peringatan'
        ];

        $parent = [
            null, null, null,
            3, 3, 3,
            6, 6, null,
            null, null, null,
            12, 12, null,
            15, 15, null,
            18, 18, null,
            21, 21, 21,
            null, null,
        ];

        $url = [
            'superAdmin', 'hrd', null,
            'staff', 'staffCuti', null,
            'staffCuti/create', 'staffPengajuanCuti', 'manajemen',
            'peraturan', 'pegawai', null,
            'jabatan', 'riwayatJabatan', null,
            'divisi', 'riwayatDivisi', null,
            'presensi', 'rekapPresensi', null,
            'cuti', 'cuti/cutiBersama', 'rekapCuti',
            null, null
        ];

        $icon = [
            'icon-rocket', 'icon-rocket', 'icon-user',
            null, null, null,
            null, null, 'icon-key',
            'icon-info3', 'icon-users', 'icon-user-tie',
            null, null, 'icon-hat',
            null, null, 'icon-notebook',
            null, null, 'icon-furniture',
            null, null, null,
            'icon-cash3', 'icon-mail'

        ];

        $id_hak_akses = [
            1, 2, 3,
            3, 3, 3,
            3, 3, 4,
            5, 6, 7,
            7, 7, 8,
            8, 8, 9,
            9, 9, 10,
            10, 10, 10,
            11, 12
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
