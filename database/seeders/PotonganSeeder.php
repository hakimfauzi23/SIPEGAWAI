<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PotonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $count = DB::table('potongan')->count();

        if ($count == 0) {
            DB::table('potongan')->insert([
                [
                    'nama' => 'Potongan Keterlambatan (per Hari)',
                    'jumlah' => 50000,
                    'is_shown' => 0,
                ],
                [
                    'nama' => 'Potongan Membolos Kerja (per Hari)',
                    'jumlah' => 150000,
                    'is_shown' => 0,
                ],
                [
                    'nama' => 'Potongan BPJS Kesehatan',
                    'jumlah' => 0,
                    'is_shown' => 0,
                ],
                [
                    'nama' => 'Potongan BPJS Ketenagakerjaan',
                    'jumlah' => 0,
                    'is_shown' => 0,
                ],
                [
                    'nama' => 'Potongan PPH 21',
                    'jumlah' => 0,
                    'is_shown' => 0,
                ],
            ]);
        }
    }
}
