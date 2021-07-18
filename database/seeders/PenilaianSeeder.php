<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PenilaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $pegawai = Pegawai::pluck('id');
        $faker = Faker::create('id_ID');

        foreach ($pegawai as $id_peg) {
            DB::table('penilaian_pegawai')->insert([
                'id_pegawai' => $id_peg,
                'tanggal' => date("Y-m-d"),
                'responsible' => $faker->numberBetween(50, 100),
                'initiate' => $faker->numberBetween(50, 100),
                'teamwork' => $faker->numberBetween(50, 100),
                'discipline' => $faker->numberBetween(50, 100),
                'work_performance' => $faker->numberBetween(50, 100),
                'final_value' => $faker->numberBetween(50, 100),

            ]);
        }
    }
}
