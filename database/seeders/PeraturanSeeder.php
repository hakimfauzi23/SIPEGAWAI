<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PeraturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $count = DB::table('peraturan')->count();

        if ($count == 0) {


            DB::table('peraturan')->insert([
                'jam_masuk' => "08:30",
                'jam_plg' => "16:30",
                'jml_cuti_tahunan' => 12,
                'jml_cuti_besar' => 30,
                'jml_cuti_hamil' => 45,
                'jml_cuti_sakit' => 99,
                'jml_cuti_penting' => 15,
                'syarat_bulan_cuti_tahunan' => 12,
                'syarat_bulan_cuti_besar' => 60,

            ]);
        }
    }
}
