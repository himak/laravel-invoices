<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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

        \App\Models\User::factory(1)
            ->hasCustomers(15)
            ->hasItems(15)
            ->create();
    }
}
