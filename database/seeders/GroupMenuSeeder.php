<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class GroupMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $count = DB::table('group_menu')->count();

        if ($count == 0) {

            DB::table('group_menu')->insert([
                [
                    'nm_group' => 'empty'
                ],
                [
                    'nm_group' => 'PEGAWAI'
                ],
                [
                    'nm_group' => 'DIVISI'
                ],
                [
                    'nm_group' => 'JABATAN'
                ],
                [
                    'nm_group' => 'CUTI'
                ],
                [
                    'nm_group' => 'PRESENSI'
                ],
            ]);
        }
    }
}
