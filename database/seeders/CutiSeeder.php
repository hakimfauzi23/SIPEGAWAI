<?php

namespace Database\Seeders;

use App\Models\Pegawai;
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

        $tp_cuti = array('Tahunan', 'Besar', 'Bersama', 'Hamil', 'Sakit', 'Penting');
        $stat = array('Ditolak Atasan', 'Disetujui Atasan', 'Disetujui HRD', 'Ditolak HRD', 'Diproses');
        $pegawai = Pegawai::pluck('id');


            for ($i = 0; $i < 1; $i++) {
                DB::table('cuti')->insert([
                    'id_pegawai' => 21070003,
                    'tipe_cuti' => $tp_cuti[$faker->numberBetween(0, 4)],
                    // 'tgl_pengajuan' => $faker->date,
                    'tgl_pengajuan' => date("2021-m-d"),
                    'tgl_mulai' => date("2021-m-d"),
                    'tgl_selesai' => date("2021-m-d"),
                    'ket' => $faker->sentence(5),
                    'status' => $stat[$faker->numberBetween(4, 4)],
                    'tgl_disetujui_atasan' => $faker->date,
                    'tgl_ditolak_atasan' => $faker->date,
                    'tgl_disetujui_hrd' => $faker->date,
                    'tgl_ditolak_hrd' => $faker->date,

                ]);
            // foreach ($pegawai as $id_peg) {
            //     for ($x = 1; $x <= 12; $x++) {
            //         for ($i = 0; $i < 5; $i++) {
            //             DB::table('cuti')->insert([
            //                 'id_pegawai' => $id_peg,
            //                 'tipe_cuti' => $tp_cuti[$faker->numberBetween(0, 4)],
            //                 // 'tgl_pengajuan' => $faker->date,
            //                 'tgl_pengajuan' => date("2021-$x-d"),
            //                 'tgl_mulai' => date("2021-$x-d"),
            //                 'tgl_selesai' => date("2021-$x-d"),
            //                 'ket' => $faker->sentence(5),
            //                 'status' => $stat[$faker->numberBetween(0, 4)],
            //                 'tgl_disetujui_atasan' => $faker->date,
            //                 'tgl_ditolak_atasan' => $faker->date,
            //                 'tgl_disetujui_hrd' => $faker->date,
            //                 'tgl_ditolak_hrd' => $faker->date,

            //             ]);
            //         }
            //     }
        }
    }
}
