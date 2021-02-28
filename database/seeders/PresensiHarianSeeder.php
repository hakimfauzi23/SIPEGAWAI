<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PresensiHarianSeeder extends Seeder
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
        $ket = array('Hadir','Cuti','Alpha');

        for ($i=1; $i < 3 ; $i++) { 
            DB::table('presensi_harian')->insert([
                'id_pegawai' => 21020001,
                'tanggal' => $faker->date,
                'ket' => $ket[$faker->numberBetween(0, 2)],
                'jam_dtg' => $faker->time('H:i'),
                'jam_plg' => $faker->time('H:i'),
            ]);
        }
    }
}
