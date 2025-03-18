<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Database\Seeder;

class CartsTableSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('email', 'user@gmail.com')->first();
        $products = Product::take(2)->get();

        // Ensure there are at least two products
        if ($products->count() < 2) {
            return;
        }

        // For the first product, get a size if available
        $product1 = $products[0];
        $size1 = $product1->sizes()->first();

        Cart::create([
            'user_id' => $user->id,
            'product_id' => $product1->id,
            'product_size_id' => $size1 ? $size1->id : null,
            'quantity' => 2,
        ]);

        // For the second product, get a size if available
        $product2 = $products[1];
        $size2 = $product2->sizes()->first();

        Cart::create([
            'user_id' => $user->id,
            'product_id' => $product2->id,
            'product_size_id' => $size2 ? $size2->id : null,
            'quantity' => 1,
        ]);
    }
}
