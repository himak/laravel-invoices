<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i<=10; $i++) {
            DB::table('invoices')->insert([
                'user_id' => random_int(1,3),
                'customer_id' => random_int(1,10),
                'invoice_number' => 'INV' . now()->year . '00' . $i,
                'due_date' => now()->addDay($i*10)->toDateString(),
                'total_price' => 10000.10,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
