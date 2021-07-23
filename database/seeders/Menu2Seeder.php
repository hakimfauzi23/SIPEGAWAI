<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class Menu2Seeder extends Seeder
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
            'Dashboard Admin', 'Dashboard HRD',

            'Menu Staff',
            'Dashboard Staff', 'Riwayat Pengajuan Cuti', 'Buat Pengajuan Cuti',
            'Pengajuan Cuti (Tahap Atasan)', 'Penilaian Karyawan',

            'Data Master',
            'Data Role & Menu', 'Data Informasi Perusahaan', 'Data Peraturan Kantor',
            'Data Jabatan', 'Data Divisi', 'Data Pegawai',
            'Data Tunjangan', 'Data Potongan',

            'Data Presensi',
            'List Data Presensi', 'Rekapan Data Presensi ',

            'Data Cuti',
            'List Data Cuti', 'Atur Tanggal Cuti Bersama', 'Pengajuan Cuti (Tahap HRD)',
            'Rekapan Data Cuti Pegawai',

            'Data Gaji', 'Surat Peringatan', 'Export Kinerja Pegawai',
        ];



        // 'menu-staff' = 3
        // 'menu-master' = 9
        // 'menu-presensi' =18
        // 'menu-cuti'=21

        $parent = [
            null, null,

            null,
            3, 3, 3,
            3, 3,

            null,
            9, 9, 9,
            9, 9, 9,
            9, 9,

            null,
            18, 18,

            null,
            21, 21, 21,
            21,

            null, null, null,
        ];

        $url = [
            'superAdmin', 'hrd',

            null,
            'staff', 'staffCuti', 'staffCuti/create',
            'staffPengajuanCuti', 'penilaian',

            null,
            'manajemen', 'perusahaan', 'peraturan',
            'jabatan', 'divisi', 'pegawai',
            'tunjangan', 'potongan',

            null,
            'presensi', 'rekapPresensi',

            null,
            'cuti', 'cuti/cutiBersama', 'hrdPengajuanCuti',
            'rekapCuti',

            'gaji', 'suratPeringatan', 'report',

        ];

        $icon = [
            'icon-rocket', 'icon-rocket',

            'icon-user',
            null, null, null,
            null, null,

            'icon-gear',
            null, null, null,
            null, null, null,
            null, null,

            'icon-notebook',
            null, null,

            'icon-furniture',
            null, null, null,
            null,

            'icon-cash3', ' icon-file-text2', 'icon-magazine',
        ];

        // 'dashboard-admin'=1
        // 'dashboard-hrd'= 2
        // 'menu-staff'=3
        // 'menu-master'=4
        // 'menu-presensi'=5
        // 'menu-cuti'=6
        // 'menu-gaji'=7
        // 'menu-surat-peringatan'=8
        // 'menu-export-kinerja'=9


        $id_hak_akses = [
            1, 2,

            3,
            3, 3, 3,
            3, 3,

            4,
            4, 4, 4,
            4, 4, 4,
            4, 4,

            5,
            5, 5,

            6,
            6, 6, 6,
            6,

            7, 8, 9,

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
