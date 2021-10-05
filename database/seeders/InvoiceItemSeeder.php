<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item = Item::first();

        $count = Invoice::count();

        for ($i=1; $i<=$count; $i++) {
            DB::table('invoice_items')->insert([
                'invoice_id' => $i,
                'item_id' => $item->id,
                'name' => $item->name,
                'price' => $item->price,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('invoices')->update(['total_price' => $item->price]);
        }

        // TODO: change total_price in Invoices table from InvoiceItems

    }
}
