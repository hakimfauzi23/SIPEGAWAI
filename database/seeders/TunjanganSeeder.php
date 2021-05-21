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
                    'nama' => 'Bonus Project',
                    'jumlah' => 500000,
                ],
                [
                    'nama' => 'Tunjangan Menikah',
                    'jumlah' => 250000,
                ],
                [
                    'nama' => 'Tunjangan Kematian',
                    'jumlah' => 1000000,
                ],
            ]);
        }
    }
}
