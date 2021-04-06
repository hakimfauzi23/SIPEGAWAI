<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = [
            [
                'username' => 'superAdmin',
                'name' => 'ini akun Admin',
                'email' => 'admin@example.com',
                'level' => 'admin',
                'password' => bcrypt('123456'),
            ],
            [
                'username' => 'user',
                'name' => 'ini akun User (non admin)',
                'email' => 'user@example.com',
                'level' => 'editor',
                'password' => bcrypt('123456'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
