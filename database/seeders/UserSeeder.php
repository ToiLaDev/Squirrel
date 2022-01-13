<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'username' => 'mrvns',
            'email' => 'mrvns@live.com',
            'first_name' => 'Hieu',
            'last_name' => 'Tran',
            'gender' => 'male',
            'status' => 1,
            'password' => Hash::make('123123'),
        ];

        DB::table('employees')->insert($user);
        DB::table('users')->insert($user);
    }
}
