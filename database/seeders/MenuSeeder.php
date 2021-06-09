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
            'Dashboard Admin', 'Dashboard HRD', 'Menu Staff', 'Dashboard Staff', 'Riwayat Pengajuan Cuti',
            'Buat Pengajuan Cuti', 'Pengajuan Cuti (Tahap Atasan)', 'Manajemen Role & Menu', 'Kebijakan Cuti & Jam Kantor', 'Data Pegawai',
            'Data Jabatan', 'List Data Jabatan', 'Data Riwayat Jabatan', 'Data Divisi', 'List Data Divisi',
            'Data Riwayat Divisi', 'Data Presensi', 'List Data Presensi', 'Rekapan Data Presensi Pegawai', 'Data Cuti',
            'List Data Cuti', 'Atur Tanggal Cuti Bersama', 'Pengajuan Cuti (Tahap HRD)', 'Rekapan Data Cuti Pegawai', 'Data Gaji',
            'Data Tunjangan', 'Data Potongan', 'Data Slip Gaji ', 'Surat Peringatan', 'Export Kinerja Pegawai'
        ];

        // 3 = Menu Staff
        // 11 = Data Jabatan
        // 14 = Data Divisi
        // 17 = Data Presensi
        // 20 = Data Cuti
        // 25 = Data Gaji

        $parent = [
            null, null, null, 3, 3,
            3, 3, null, null, null,
            null, 11, 11, null, 14,
            14, null, 17, 17, null,
            20, 20, 20, 20, null,
            25, 25, 25, null, null
        ];

        $url = [
            'superAdmin', 'hrd', null, 'staff', 'staffCuti',
            'staffCuti/create', 'staffPengajuanCuti', 'manajemen', 'peraturan', 'pegawai',
            null, 'jabatan', 'riwayatJabatan', null, 'divisi',
            'riwayatDivisi', null, 'presensi', 'rekapPresensi', null,
            'cuti', 'cuti/cutiBersama', 'hrdPengajuanCuti', 'rekapCuti', null,
            'tunjangan', 'potongan', 'gaji', 'suratPeringatan', 'report'
        ];

        $icon = [
            'icon-rocket', 'icon-rocket', 'icon-user', null, null,
            null, null, 'icon-key', 'icon-info3', 'icon-users',
            'icon-user-tie', null, null, 'icon-hat', null,
            null, 'icon-notebook', null, null, 'icon-furniture',
            null, null, null, null, 'icon-cash3',
            null, null, null, ' icon-file-text2', 'icon-magazine',

        ];


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

        $id_hak_akses = [
            1, 2, 3, 3, 3,
            3, 3, 4, 5, 6,
            7, 7, 7, 8, 8,
            8, 9, 9, 9, 10,
            10, 10, 10, 10, 11,
            11, 11, 11, 12, 13,

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
