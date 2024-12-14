<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Item::factory()->create([
            'name' => 'domain',
        ]);

        \App\Models\Item::factory()->create([
            'name' => 'website',
        ]);

        \App\Models\Item::factory()->create([
            'name' => 'design',
        ]);
    }
}
