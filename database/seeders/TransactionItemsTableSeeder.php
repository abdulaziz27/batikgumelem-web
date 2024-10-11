<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Product;
use Illuminate\Database\Seeder;

class TransactionItemsTableSeeder extends Seeder
{
    public function run()
    {
        $transaction = Transaction::first();
        $products = Product::all();

        TransactionItem::create([
            'transaction_id' => $transaction->id,
            'product_id' => $products[0]->id,
            'quantity' => 1,
            'price' => $products[0]->price,
        ]);

        TransactionItem::create([
            'transaction_id' => $transaction->id,
            'product_id' => $products[1]->id,
            'quantity' => 1,
            'price' => $products[1]->price,
        ]);
    }
}
