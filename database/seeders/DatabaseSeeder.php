<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@quotationapp.com',
            'password' => Hash::make('password'),
            // 'email_verified_at' => (new \DateTime())->format('Y-m-d H:i:s')
        ]);
    }
}
