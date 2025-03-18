<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Database\Seeder;

class TransactionItemsTableSeeder extends Seeder
{
    public function run()
    {
        $transactions = Transaction::all();
        $products = Product::all();

        // Skip if no products or transactions exist
        if ($products->count() < 2 || $transactions->count() < 1) {
            return;
        }

        // Items for the first (pending) transaction
        $transaction1 = $transactions->first();
        $product1 = $products[0];
        $product2 = $products[1];

        // Get sizes if available
        $size1 = $product1->sizes()->first();
        $size2 = $product2->sizes()->first();

        TransactionItem::create([
            'transaction_id' => $transaction1->id,
            'product_id' => $product1->id,
            'product_size_id' => $size1 ? $size1->id : null,
            'size_name' => $size1 ? $size1->name : null,
            'quantity' => 1,
            'price' => $product1->price,
        ]);

        TransactionItem::create([
            'transaction_id' => $transaction1->id,
            'product_id' => $product2->id,
            'product_size_id' => $size2 ? $size2->id : null,
            'size_name' => $size2 ? $size2->name : null,
            'quantity' => 1,
            'price' => $product2->price,
        ]);

        // If we have a second (completed) transaction, add items to it
        if ($transactions->count() > 1) {
            $transaction2 = $transactions[1];

            // Use different products if available
            $product3 = $products->count() > 2 ? $products[2] : $product1;
            $size3 = $product3->sizes()->first();

            TransactionItem::create([
                'transaction_id' => $transaction2->id,
                'product_id' => $product3->id,
                'product_size_id' => $size3 ? $size3->id : null,
                'size_name' => $size3 ? $size3->name : null,
                'quantity' => 1,
                'price' => $product3->price,
            ]);
        }
    }
}
