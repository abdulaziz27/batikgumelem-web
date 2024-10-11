<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogsTableSeeder extends Seeder
{
    public function run()
    {
        $admin = User::where('email', 'admin@gmail.com')->first();

        $blogs = [
            [
                'title' => 'Sejarah Batik di Indonesia',
                'content' => 'Batik telah menjadi bagian penting dari warisan budaya Indonesia selama berabad-abad. Seni membatik dimulai sebagai tradisi kerajaan di Pulau Jawa...',
                'user_id' => $admin->id,
                'published_at' => now()->subDays(30),
                'slug' => Str::slug('Sejarah Batik di Indonesia'), // Generate slug
            ],
            [
                'title' => 'Perbedaan Batik Tulis, Cap, dan Printing',
                'content' => 'Ada tiga jenis utama batik yang dikenal di Indonesia: batik tulis, batik cap, dan batik printing. Masing-masing memiliki proses pembuatan dan karakteristik yang unik...',
                'user_id' => $admin->id,
                'published_at' => now()->subDays(20),
                'slug' => Str::slug('Perbedaan Batik Tulis, Cap, dan Printing'), // Generate slug
            ],
            [
                'title' => 'Merawat Kain Batik Agar Tahan Lama',
                'content' => 'Kain batik adalah investasi yang berharga dan dengan perawatan yang tepat, dapat bertahan selama bertahun-tahun. Berikut adalah beberapa tips untuk merawat kain batik Anda...',
                'user_id' => $admin->id,
                'published_at' => now()->subDays(10),
                'slug' => Str::slug('Merawat Kain Batik Agar Tahan Lama'), // Generate slug
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::create($blog);
        }
    }
}
