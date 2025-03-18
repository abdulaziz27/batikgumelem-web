<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use Illuminate\Database\Seeder;

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
                'name' => 'Batik Tulis Sekar Jagad',
                'slug' => 'batik-tulis-sekar-jagad',
                'price' => 1200000,
                'description' => '<p>Batik Tulis Sekar Jagad adalah salah satu motif batik klasik yang menggambarkan keberagaman alam semesta.</p><p>Motif ini melambangkan keindahan dan keanekaragaman dunia dalam satu kesatuan utuh.</p><p>Dibuat dengan teknik tulis tangan (canting) secara tradisional oleh pengrajin batik Gumelem yang terampil.</p>',
                'category_id' => 1,
                'stock' => 15,
                'galleries' => [
                    ['url' => 'product-images/01J8F4P4YJNRFP076E70TZPRVA.png', 'is_featured' => true],
                    ['url' => 'product-images/01J8F4P4YJNRFP076E70TZPRVA.png', 'is_featured' => false],
                    ['url' => 'product-images/01J8F4P4YJNRFP076E70TZPRVA.png', 'is_featured' => false],
                ],
                'sizes' => [
                    ['name' => 'S', 'description' => 'Length: 200cm, Width: 110cm', 'stock' => 5],
                    ['name' => 'M', 'description' => 'Length: 220cm, Width: 115cm', 'stock' => 7],
                    ['name' => 'L', 'description' => 'Length: 240cm, Width: 120cm', 'stock' => 3],
                ],
            ],
            [
                'name' => 'Batik Cap Parang Rusak',
                'slug' => 'batik-cap-parang-rusak',
                'price' => 850000,
                'description' => '<p>Batik Cap Parang Rusak adalah motif batik tradisional dengan pola diagonal yang terinspirasi dari bentuk ombak laut.</p><p>Dibuat dengan teknik cap menggunakan alat tembaga (cap) yang dihiasi dengan pola parang.</p><p>Motif ini melambangkan kekuatan dan ketahanan dalam menghadapi rintangan.</p>',
                'category_id' => 2,
                'stock' => 20,
                'galleries' => [
                    ['url' => 'product-images/01J8F4P4YNG39C3H9W5QTZVYMJ.png', 'is_featured' => true],
                    ['url' => 'product-images/01J8F4P4YNG39C3H9W5QTZVYMJ.png', 'is_featured' => false],
                    ['url' => 'product-images/01J8F4P4YNG39C3H9W5QTZVYMJ.png', 'is_featured' => false],
                ],
                'sizes' => [
                    ['name' => 'S', 'description' => 'Length: 200cm, Width: 110cm', 'stock' => 8],
                    ['name' => 'M', 'description' => 'Length: 220cm, Width: 115cm', 'stock' => 7],
                    ['name' => 'L', 'description' => 'Length: 240cm, Width: 120cm', 'stock' => 5],
                ],
            ],
            [
                'name' => 'Batik Print Megamendung',
                'slug' => 'batik-print-megamendung',
                'price' => 450000,
                'description' => '<p>Batik Print Megamendung adalah interpretasi modern dari motif tradisional Cirebon.</p><p>Dibuat dengan teknik printing yang menghasilkan warna-warna cerah dan konsisten.</p><p>Motif awan yang bertumpuk melambangkan harapan akan datangnya hujan yang membawa kesuburan.</p>',
                'category_id' => 3,
                'stock' => 30,
                'galleries' => [
                    ['url' => 'product-images/01J8FF6P878E15Q3PWFYMH1AKS.png', 'is_featured' => true],
                    ['url' => 'product-images/01J8FF6P878E15Q3PWFYMH1AKS.png', 'is_featured' => false],
                    ['url' => 'product-images/01J8FF6P878E15Q3PWFYMH1AKS.png', 'is_featured' => false],
                ],
                'sizes' => [
                    ['name' => 'S', 'description' => 'Length: 200cm, Width: 110cm', 'stock' => 10],
                    ['name' => 'M', 'description' => 'Length: 220cm, Width: 115cm', 'stock' => 10],
                    ['name' => 'L', 'description' => 'Length: 240cm, Width: 120cm', 'stock' => 10],
                ],
            ],
            [
                'name' => 'Batik Tulis Kawung',
                'slug' => 'batik-tulis-kawung',
                'price' => 1350000,
                'description' => '<p>Batik Tulis Kawung adalah motif klasik berbentuk bulat yang disusun geometris.</p><p>Dikerjakan secara teliti oleh pengrajin Gumelem dengan teknik tulis tradisional.</p><p>Motif ini melambangkan harapan akan umur panjang dan kesempurnaan hidup.</p>',
                'category_id' => 1,
                'stock' => 12,
                'galleries' => [
                    ['url' => 'product-images/01J8F5M5ZY3AQSJZ469DAW8QHR.png', 'is_featured' => true],
                    ['url' => 'product-images/01J8F5M5ZY3AQSJZ469DAW8QHR.png', 'is_featured' => false],
                    ['url' => 'product-images/01J8F5M5ZY3AQSJZ469DAW8QHR.png', 'is_featured' => false],
                ],
                'sizes' => [
                    ['name' => 'S', 'description' => 'Length: 200cm, Width: 110cm', 'stock' => 4],
                    ['name' => 'M', 'description' => 'Length: 220cm, Width: 115cm', 'stock' => 5],
                    ['name' => 'L', 'description' => 'Length: 240cm, Width: 120cm', 'stock' => 3],
                ],
            ],
            [
                'name' => 'Batik Cap Sidomukti',
                'slug' => 'batik-cap-sidomukti',
                'price' => 780000,
                'description' => '<p>Batik Cap Sidomukti adalah motif tradisional dengan pattern yang teratur dan simetris.</p><p>Dibuat dengan teknik cap yang menghasilkan konsistensi pola yang baik.</p><p>Motif ini melambangkan kemakmuran dan kebahagiaan dalam kehidupan.</p>',
                'category_id' => 2,
                'stock' => 18,
                'galleries' => [
                    ['url' => 'product-images/01J8FF6P878E15Q3PWFYMH1AKS.png', 'is_featured' => true],
                    ['url' => 'product-images/01J8FF6P878E15Q3PWFYMH1AKS.png', 'is_featured' => false],
                    ['url' => 'product-images/01J8FF6P878E15Q3PWFYMH1AKS.png', 'is_featured' => false],
                ],
                'sizes' => [
                    ['name' => 'S', 'description' => 'Length: 200cm, Width: 110cm', 'stock' => 6],
                    ['name' => 'M', 'description' => 'Length: 220cm, Width: 115cm', 'stock' => 8],
                    ['name' => 'L', 'description' => 'Length: 240cm, Width: 120cm', 'stock' => 4],
                ],
            ],
        ];

        // Memasukkan data produk ke dalam database
        foreach ($products as $productData) {
            // Simpan data produk dasar
            $product = Product::create([
                'name' => $productData['name'],
                'slug' => $productData['slug'],
                'price' => $productData['price'],
                'description' => $productData['description'],
                'category_id' => $productData['category_id'],
                'stock' => $productData['stock'],
            ]);

            // Tambahkan galeri produk
            foreach ($productData['galleries'] as $gallery) {
                ProductGallery::create([
                    'product_id' => $product->id,
                    'url' => $gallery['url'],
                    'is_featured' => $gallery['is_featured'],
                ]);
            }

            // Tambahkan ukuran produk
            foreach ($productData['sizes'] as $size) {
                ProductSize::create([
                    'product_id' => $product->id,
                    'name' => $size['name'],
                    'description' => $size['description'],
                    'stock' => $size['stock'],
                ]);
            }
        }
    }
}
