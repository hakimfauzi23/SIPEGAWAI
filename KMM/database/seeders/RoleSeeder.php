<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $count = DB::table('role')->count();

        if ($count == 0) {

            DB::table('role')->insert([
                [
                    'nm_role' => 'superAdmin',
                    'url' => '/admin',
                ],
                [
                    'nm_role' => 'hrd',
                    'url' => '/hrd',
                ],
                [
                    'nm_role' => 'staff',
                    'url' => '/staff',
                ],
            ]);
        }
    }
}