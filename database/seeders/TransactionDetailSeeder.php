<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TransactionDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaction_details')->insert([
            'transactions_id' => 1,
            'products_id' => 1,
            'order_quantity' => 2,
        ],[
            'transactions_id' => 1,
            'products_id' => 2,
            'order_quantity' => 2,
        ]);
    }
}
