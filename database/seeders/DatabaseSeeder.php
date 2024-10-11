<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            CategoriesTableSeeder::class,
            ProductsTableSeeder::class,
            CartsTableSeeder::class,
            BlogsTableSeeder::class,
            TransactionsTableSeeder::class,
            TransactionItemsTableSeeder::class,
        ]);
    }
}
