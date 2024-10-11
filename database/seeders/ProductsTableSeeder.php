<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data produk dan galeri yang akan dimasukkan secara manual
        $products = [
            [
                'name' => 'Product 1',
                'slug' => 'product-1',
                'price' => 100000,
                'description' => 'This is the description for Product 1',
                'category_id' => 1,
                'galleries' => [
                    ['url' => 'product-images/01J8F4P4YJNRFP076E70TZPRVA.png', 'is_featured' => true],
                    ['url' => 'product-images/01J8F4P4YJNRFP076E70TZPRVA.png', 'is_featured' => false],
                    ['url' => 'product-images/01J8F4P4YJNRFP076E70TZPRVA.png', 'is_featured' => false],
                ],
            ],
            [
                'name' => 'Product 2',
                'slug' => 'product-2',
                'price' => 200000,
                'description' => 'This is the description for Product 2',
                'category_id' => 2,
                'galleries' => [
                    ['url' => 'product-images/01J8F4P4YNG39C3H9W5QTZVYMJ.png', 'is_featured' => true],
                    ['url' => 'product-images/01J8F4P4YNG39C3H9W5QTZVYMJ.png', 'is_featured' => false],
                    ['url' => 'product-images/01J8F4P4YNG39C3H9W5QTZVYMJ.png', 'is_featured' => false],
                ],
            ],
            [
                'name' => 'Product 3',
                'slug' => 'product-3',
                'price' => 200000,
                'description' => 'This is the description for Product 3',
                'category_id' => 2,
                'galleries' => [
                    ['url' => 'product-images/01J8FF6P878E15Q3PWFYMH1AKS.png', 'is_featured' => true],
                    ['url' => 'product-images/01J8FF6P878E15Q3PWFYMH1AKS.png', 'is_featured' => false],
                    ['url' => 'product-images/01J8FF6P878E15Q3PWFYMH1AKS.png', 'is_featured' => false],
                ],
            ],
            [
                'name' => 'Product 4',
                'slug' => 'product-4',
                'price' => 200000,
                'description' => 'This is the description for Product 2',
                'category_id' => 2,
                'galleries' => [
                    ['url' => 'product-images/01J8F5M5ZY3AQSJZ469DAW8QHR.png', 'is_featured' => true],
                    ['url' => 'product-images/01J8F5M5ZY3AQSJZ469DAW8QHR.png', 'is_featured' => false],
                    ['url' => 'product-images/01J8F5M5ZY3AQSJZ469DAW8QHR.png', 'is_featured' => false],
                ],
            ],
            [
                'name' => 'Product 5',
                'slug' => 'product-5',
                'price' => 300000,
                'description' => 'This is the description for Product 3',
                'category_id' => 2,
                'galleries' => [
                    ['url' => 'product-images/01J8FF6P878E15Q3PWFYMH1AKS.png', 'is_featured' => true],
                    ['url' => 'product-images/01J8FF6P878E15Q3PWFYMH1AKS.png', 'is_featured' => false],
                    ['url' => 'product-images/01J8FF6P878E15Q3PWFYMH1AKS.png', 'is_featured' => false],
                ],
            ],
        ];

        // Memasukkan data produk ke dalam database
        foreach ($products as $product) {
            // Memasukkan produk
            $productId = DB::table('products')->insertGetId([
                'name' => $product['name'],
                'slug' => $product['slug'],
                'price' => $product['price'],
                'description' => $product['description'],
                'category_id' => $product['category_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Memasukkan galeri untuk produk ini
            foreach ($product['galleries'] as $gallery) {
                DB::table('product_galleries')->insert([
                    'product_id' => $productId,
                    'url' => $gallery['url'],
                    'is_featured' => $gallery['is_featured'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
