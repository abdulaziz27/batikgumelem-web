<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Batik Tulis',
                'slug' => 'batik-tulis',
                'image' => 'category-images/category-image-1.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Batik Cap',
                'slug' => 'batik-cap',
                'image' => 'category-images/category-image-1.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Batik Print',
                'slug' => 'batik-print',
                'image' => 'category-images/category-image-1.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Paling Populer',
                'slug' => 'paling-populer',
                'image' => 'category-images/category-image-1.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
