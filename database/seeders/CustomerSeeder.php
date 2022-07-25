<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'customer1',
            'username' => 'cust1',
            'email' => 'customer1@gmail.com',
            'password' =>Hash::make(12345678),
            'user_type' => 1
        ]);

    }
}
