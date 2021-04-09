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
                    'nm_jabatan' => 'Chief Executive Officer',
                    'gaji_pokok' => '20000000',
                ],
                [
                    'nm_jabatan' => 'Head of Business Development',
                    'gaji_pokok' => '10000000',
                ],
                [
                    'nm_jabatan' => 'Chief Technology Officer',
                    'gaji_pokok' => '10000000',
                ],
                [
                    'nm_jabatan' => 'Head of Finance',
                    'gaji_pokok' => '10000000',
                ],
                [
                    'nm_jabatan' => 'Finance Staff',
                    'gaji_pokok' => '9000000',
                ],
                [
                    'nm_jabatan' => 'FE Manager',
                    'gaji_pokok' => '7000000',
                ],
                [
                    'nm_jabatan' => 'BE Manager',
                    'gaji_pokok' => '7000000',
                ],
                [
                    'nm_jabatan' => 'Mobile Manager',
                    'gaji_pokok' => '7000000',
                ],
                [
                    'nm_jabatan' => 'DevOps Manager',
                    'gaji_pokok' => '7000000',
                ],
                [
                    'nm_jabatan' => 'Elite Engineer ',
                    'gaji_pokok' => '7000000',
                ],
                [
                    'nm_jabatan' => 'Engineer Staff ',
                    'gaji_pokok' => '7000000',
                ],
                [
                    'nm_jabatan' => 'R & D Director',
                    'gaji_pokok' => '5000000',
                ],
                [
                    'nm_jabatan' => 'Engineer Platform',
                    'gaji_pokok' => '9000000',
                ],

                [
                    'nm_jabatan' => 'Training Director',
                    'gaji_pokok' => '9000000',
                ],
                [
                    'nm_jabatan' => 'Training Manager',
                    'gaji_pokok' => '9000000',
                ],
                [
                    'nm_jabatan' => 'Training Staff',
                    'gaji_pokok' => '9000000',
                ],
                [
                    'nm_jabatan' => 'PM',
                    'gaji_pokok' => '9000000',
                ],
                [
                    'nm_jabatan' => 'QA Coord.',
                    'gaji_pokok' => '9000000',
                ],
                [
                    'nm_jabatan' => 'QA Staff',
                    'gaji_pokok' => '9000000',
                ],
                [
                    'nm_jabatan' => 'Marketing & Admin Coord.',
                    'gaji_pokok' => '9000000',
                ],
                [
                    'nm_jabatan' => 'Admin Staff',
                    'gaji_pokok' => '9000000',
                ],
                [
                    'nm_jabatan' => 'Content Coord.',
                    'gaji_pokok' => '9000000',
                ],
                [
                    'nm_jabatan' => 'Content Staff',
                    'gaji_pokok' => '9000000',
                ],
                [
                    'nm_jabatan' => 'HRD Coord.',
                    'gaji_pokok' => '9000000',
                ],
                [
                    'nm_jabatan' => 'HR Staff',
                    'gaji_pokok' => '9000000',
                ],
                [
                    'nm_jabatan' => 'Operasional',
                    'gaji_pokok' => '9000000',
                ],


            ]);
        }
    }
}
