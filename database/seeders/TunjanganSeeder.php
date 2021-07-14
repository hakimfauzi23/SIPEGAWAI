<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TunjanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $count = DB::table('tunjangan')->count();

        if ($count == 0) {
            DB::table('tunjangan')->insert([
                [
                    'nama' => 'Tunjangan Makan',
                    'jumlah' => 200000,
                ],
                [
                    'nama' => 'Tunjangan Anak (Per Anak)',
                    'jumlah' => 2,
                ],
                [
                    'nama' => 'Tunjangan Keluarga',
                    'jumlah' => 10,
                ],
            ]);
        }
    }
}
