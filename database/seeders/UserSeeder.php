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
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@mail.test',
           // 'business_name' => 'Admin company, s. r. o.', 
//            'identification_code' => '12345678',
            'password' => \Hash::make('Admin@123'),
        ]);
        
        \App\Models\User::factory()->create([
            'name' => 'kafex',
            'email' => 'kafex@kafex.sk',
            'business_name' => 'Kafex, s. r. o.', 
            'identification_code' => '47566981',
            'password' => \Hash::make('Kafex@123'),
        ]);
    }
}
