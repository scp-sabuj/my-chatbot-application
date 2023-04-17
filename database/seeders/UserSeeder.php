<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Sabuj Chandra Paul',
            'email' => 'sabujscp.311996@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => '1',
        ]);

        DB::table('admins')->insert([
            'name' => 'Sayan Chandra Paul',
            'email' => 'sabujscp1.311996@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => '2',
        ]);

        DB::table('users')->insert([
            'name' => 'Mr. User',
            'email' => 'sabujscp.311996@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
