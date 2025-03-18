<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('email', 'user@gmail.com')->first();
        $completedTransaction = Transaction::where('status', 'COMPLETED')->first();

        // Skip if prerequisites don't exist
        if (!$user || !$completedTransaction) {
            return;
        }

        // Get transaction items to determine which products were purchased
        $transactionItems = $completedTransaction->transactionItems;

        foreach ($transactionItems as $item) {
            // Create a review for each purchased product
            Review::create([
                'user_id' => $user->id,
                'product_id' => $item->product_id,
                'transaction_id' => $completedTransaction->id,
                'rating' => rand(4, 5), // Give good ratings between 4-5 stars
                'comment' => $this->getRandomComment(),
                'is_approved' => true,
                'created_at' => now()->subDays(rand(1, 5)), // Random creation date in the last 5 days
            ]);
        }

        // Add a few more reviews for other products if they exist
        $reviewedProductIds = $transactionItems->pluck('product_id')->toArray();
        $otherProducts = Product::whereNotIn('id', $reviewedProductIds)->take(3)->get();

        foreach ($otherProducts as $product) {
            Review::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'transaction_id' => null, // No transaction associated
                'rating' => rand(3, 5), // More varied ratings
                'comment' => $this->getRandomComment(),
                'is_approved' => true,
                'created_at' => now()->subDays(rand(1, 5)),
            ]);
        }
    }

    private function getRandomComment()
    {
        $comments = [
            'Kualitas batiknya sangat baik, saya sangat puas dengan pembelian ini!',
            'Warna dan motifnya lebih indah daripada yang saya harapkan. Pengerjaan rapi dan teliti.',
            'Pengiriman cepat dan produk sesuai dengan deskripsi. Terima kasih Batik Gumelem!',
            'Batik ini menjadi favorit baru saya, nyaman dipakai dan motifnya unik.',
            'Bahan kainnya lembut dan tidak luntur saat dicuci. Sangat merekomendasikan toko ini.',
            'Harga sangat sebanding dengan kualitasnya. Akan belanja lagi di sini.',
            'Motif batiknya sangat indah, detail yang halus menunjukkan keahlian pengrajinnya.',
            'Terimakasih untuk pelayanan yang sangat baik dan produk yang berkualitas.',
            'Batik ini sangat cocok untuk acara formal maupun kasual. Versatile dan elegan.',
            'Sejauh ini ini adalah batik terbaik yang pernah saya beli. Worth every penny!',
        ];

        return $comments[array_rand($comments)];
    }
}
