<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RiwayatDivisiSeeder extends Seeder
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

        for ($i = 0; $i < 3; $i++) {
            DB::table('riwayat_divisi')->insert([
                'id_pegawai' => date("ym") . "0002",
                'id_divisi' => $faker->numberBetween(1, 9),
                'tgl_mulai' => $faker->date(),
            ]);
        }
    }
}
