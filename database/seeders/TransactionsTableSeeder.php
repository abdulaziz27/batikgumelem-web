<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class TransactionsTableSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('email', 'user@gmail.com')->first();

        Transaction::create([
            'user_id' => $user->id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'address' => 'Jl. Batik No. 123, Surakarta, Jawa Tengah',
            'phone' => '081234567890',
            'courier' => 'JNE',
            'payment' => 'MIDTRANS',
            'payment_url' => 'https://example.com/payment/123456',
            'total_price' => 2250000,
            'status' => 'PENDING',
        ]);

        // Create a completed transaction for review seeding
        Transaction::create([
            'user_id' => $user->id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'address' => 'Jl. Batik No. 123, Surakarta, Jawa Tengah',
            'phone' => '081234567890',
            'courier' => 'JNE',
            'payment' => 'MIDTRANS',
            'payment_url' => 'https://example.com/payment/123457',
            'total_price' => 1450000,
            'status' => 'COMPLETED',
            'created_at' => now()->subDays(10), // Older transaction
        ]);
    }
}
