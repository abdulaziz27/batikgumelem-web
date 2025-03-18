<?php

namespace Database\Seeders;

use App\Models\Wishlist;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class WishlistsTableSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('email', 'user@gmail.com')->first();

        if (!$user) {
            return;
        }

        // Get some products to add to wishlist
        $products = Product::inRandomOrder()->take(3)->get();

        foreach ($products as $product) {
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);
        }
    }
}
