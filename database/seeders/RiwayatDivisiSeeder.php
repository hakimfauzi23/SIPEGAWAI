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
                'id_pegawai' => 21020001,
                'id_divisi' => $faker->numberBetween(1, 9),
                'thn_mulai' => $faker->year(),
                'thn_selesai' => $faker->year(),
            ]);
        }
    }
}
