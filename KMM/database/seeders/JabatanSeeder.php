<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $count = DB::table('jabatan')->count();

        if ($count == 0) {


            DB::table('jabatan')->insert([
                [
                    'nm_jabatan' => 'Direksi',
                    'gaji_pokok' => '15000000',
                ],
                [
                    'nm_jabatan' => 'Direktur Utama',
                    'gaji_pokok' => '10000000',
                ],
                [
                    'nm_jabatan' => 'Direktur Keuangan',
                    'gaji_pokok' => '10000000',
                ],
                [
                    'nm_jabatan' => 'Direktur Personalia',
                    'gaji_pokok' => '10000000',
                ],
                [
                    'nm_jabatan' => 'Direktur ',
                    'gaji_pokok' => '7000000',
                ],
                [
                    'nm_jabatan' => 'Manager ',
                    'gaji_pokok' => '7000000',
                ],
                [
                    'nm_jabatan' => 'Manager Personalia ',
                    'gaji_pokok' => '7000000',
                ],
                [
                    'nm_jabatan' => 'Manager Pemasaran ',
                    'gaji_pokok' => '7000000',
                ],
                [
                    'nm_jabatan' => 'Staff ',
                    'gaji_pokok' => '7000000',
                ],
            ]);
        }
    }
}
