<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CartsTableSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('email', 'user@gmail.com')->first();
        $products = Product::all();

        Cart::create([
            'user_id' => $user->id,
            'product_id' => $products[0]->id,
            'quantity' => 2,
        ]);

        Cart::create([
            'user_id' => $user->id,
            'product_id' => $products[1]->id,
            'quantity' => 1,
        ]);
    }
}
