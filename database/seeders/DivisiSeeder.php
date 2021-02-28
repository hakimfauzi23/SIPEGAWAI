<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $count = DB::table('divisi')->count();

        if ($count == 0) {


            DB::table('divisi')->insert([
                [
                    'nm_divisi' => 'non-divisi',
                ],
                [
                    'nm_divisi' => 'Human Resource',
                ],
                [
                    'nm_divisi' => 'General Affairs',
                ],
                [
                    'nm_divisi' => 'Environment',
                ],
                [
                    'nm_divisi' => 'Safety',
                ],
                [
                    'nm_divisi' => 'Produksi',
                ],
                [
                    'nm_divisi' => 'Work Technical',
                ],
                [
                    'nm_divisi' => 'Quality Assurance ',
                ],
                [
                    'nm_divisi' => 'Engineering',
                ],
                [
                    'nm_divisi' => 'Accounting',
                ],
                [
                    'nm_divisi' => 'Information Technology',
                ]

            ]);
        }
    }
}
