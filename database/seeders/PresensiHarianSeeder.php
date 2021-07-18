<?php

namespace Database\Seeders;

use App\Models\Pegawai;
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

        $pegawai = Pegawai::pluck('id');
        $faker = Faker::create('id_ID');
        $ket = array('Hadir', 'Cuti', 'Alpha');

        foreach ($pegawai as $id_peg) {

            // for ($i = 1; $i <= 22; $i++) {
            //     DB::table('presensi_harian')->insert([
            //         'id_pegawai' => $id_peg,
            //         'tanggal' => date("Y-m-d"),
            //         'ket' => $ket[0],
            //         'jam_dtg' => $faker->time('8:i'),
            //         'jam_plg' => $faker->time('16:i'),
            //         'is_wfh' => 1,
            //     ]);
            // }


            for ($x = 1; $x <= 12; $x++) {
                for ($i = 1; $i <= 22; $i++) {
                    DB::table('presensi_harian')->insert([
                        'id_pegawai' => $id_peg,
                        'tanggal' => date("Y-$x-$i"),
                        'ket' => $ket[$faker->numberBetween(0, 2)],
                        'jam_dtg' => $faker->time('8:i'),
                        'jam_plg' => $faker->time('16:i'),
                        'jam_plg' => $faker->time('16:i'),
                    ]);
                }
            }
        }
    }
}
