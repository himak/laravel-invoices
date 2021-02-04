<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@mail.test',
//            'business_name' => 'Admin company, s. r. o.',
//            'identification_code' => '12345678',
            'email_verified_at' => now(),
            'password' => \Hash::make('Admin@123'),
            'remember_token' => Str::random(10)
        ]);
    }
}
