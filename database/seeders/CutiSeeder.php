<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class CutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create('id_ID');
        $count = DB::table('pegawai')->count();

        $tp_cuti = array('Tahunan', 'Besar', 'Bersama', 'Hamil', 'Sakit');
        $stat = array('Ditolak Atasan', 'Disetujui Atasan', 'Disetujui HRD', 'Ditolak HRD', 'Diproses');


        for ($i = 1; $i < 10; $i++) {
            // $id = DB::table('pegawai')->select('id')->where('id', '==', '21020001');

            DB::table('cuti')->insert([

                'id_pegawai' => date("ym") . "0001",
                'tipe_cuti' => $tp_cuti[$faker->numberBetween(0, 4)],
                // 'tgl_pengajuan' => $faker->date,
                'tgl_pengajuan' => date("Y-m-d"),
                'tgl_mulai' => date("Y-m-d"),
                'tgl_selesai' => $faker->date,
                'ket' => $faker->sentence(5),
                'status' => $stat[$faker->numberBetween(0, 3)],
                'tgl_disetujui_atasan' => $faker->date,
                'tgl_ditolak_atasan' => $faker->date,
                'tgl_disetujui_hrd' => $faker->date,
                'tgl_ditolak_hrd' => $faker->date,

            ]);
        }
    }
}
