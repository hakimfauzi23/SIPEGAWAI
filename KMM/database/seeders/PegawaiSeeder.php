<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class PegawaiSeeder extends Seeder
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
        $jk = array('Pria', 'Wanita');
        $status = array('Menikah', 'Lajang');
        $agama = array('Islam', 'Kristen', 'Katholik', 'Buddha', 'Hindu', 'Protestan');
        $atasan = array('21030001', '21030002', '21030003');

        for ($i = 0; $i <= 2; $i++) {
            $id = IdGenerator::generate(['table' => 'pegawai', 'length' => 8, 'prefix' => date('ym')]);
            $jkp = $faker->numberBetween(0, 1);
            $jbtn = $faker->numberBetween(1, 9);
            $relg = $faker->numberBetween(0, 5);
            $role = [1, 2, 3];
            $email = ['admin@gmail.com', 'hrd@gmail.com', 'staff@gmail.com'];
            $numAtasan = $faker->numberBetween(0, 2);
            $dvs = $faker->numberBetween(1, 11);

            DB::table('pegawai')->insert([
                'id' => $id,
                'id_role' => $role[$i],
                'nik' => $faker->nik(),
                'nama' => $faker->name,
                'jk' => $jk[$jkp],
                'agama' => $agama[$relg],
                'tempat_lahir' => $faker->city,
                'tgl_lahir' => $faker->date,
                'alamat_ktp' => $faker->streetAddress,
                'alamat_dom' => $faker->streetAddress,
                'status' => $status[$jkp],
                'jml_anak' => $relg,
                'no_hp' => $faker->phoneNumber,
                'email' => $email[$i],
                'password' => bcrypt('123456'),
                'tgl_masuk' => $faker->date,
                'id_atasan' => NULL,
                'id_jabatan' => $jbtn,
                'id_divisi' => $dvs,
                'path' => 'foto.jpg'
            ]);
        }
    }
}
