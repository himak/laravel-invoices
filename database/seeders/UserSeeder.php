<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@mail.test',
            // 'business_name' => 'Admin company, s. r. o.',
            //            'identification_code' => '12345678',
            'password' => Hash::make('Admin@123'),
        ]);

        User::factory(1)
            ->has(Customer::factory()->count(5))
            ->has(Item::factory()->count(15))
            ->create();
    }
}
