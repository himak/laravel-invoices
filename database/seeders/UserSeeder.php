<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@mail.test',
//            'business_name' => 'Admin company, s. r. o.',
//            'identification_code' => '12345678',
            'email_verified_at' => now(),
            'password' => \Hash::make('Admin@123'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\User::factory(2)->create();
    }
}
