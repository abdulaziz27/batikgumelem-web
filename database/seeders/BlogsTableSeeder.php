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
        $author = User::where('email', 'author@gmail.com')->first();

        if (!$admin || !$author) {
            return;
        }

        $blogs = [
            [
                'title' => 'Sejarah Batik di Indonesia',
                'content' => '<p>Batik telah menjadi bagian penting dari warisan budaya Indonesia selama berabad-abad. Seni membatik dimulai sebagai tradisi kerajaan di Pulau Jawa dan berkembang menjadi identitas budaya yang diakui dunia.</p>
                <p>Pada tahun 2009, UNESCO secara resmi mengakui batik Indonesia sebagai Warisan Budaya Tak Benda Kemanusiaan. Pengakuan ini menegaskan nilai penting batik sebagai bagian dari identitas budaya Indonesia.</p>
                <p>Setiap daerah di Indonesia memiliki motif batik khasnya masing-masing, mencerminkan keanekaragaman budaya dan tradisi lokal. Dari batik Yogyakarta dengan motif klasiknya hingga batik pesisir dengan warna-warna cerahnya, keberagaman ini adalah kekayaan yang tak ternilai.</p>
                <p>Di Banjarnegara sendiri, Batik Gumelem hadir dengan keunikannya tersendiri, menggabungkan motif-motif tradisional dengan sentuhan lokal yang khas dari wilayah Gumelem.</p>',
                'user_id' => $admin->id,
                'is_published' => true,
                'published_at' => now()->subDays(30),
                'slug' => Str::slug('Sejarah Batik di Indonesia'),
                'featured_image' => 'blog-images/sejarah-batik.jpg',
            ],
            [
                'title' => 'Perbedaan Batik Tulis, Cap, dan Printing',
                'content' => '<p>Ada tiga jenis utama batik yang dikenal di Indonesia: batik tulis, batik cap, dan batik printing. Masing-masing memiliki proses pembuatan dan karakteristik yang unik.</p>
                <p><strong>Batik Tulis</strong> adalah jenis batik paling tradisional dan berharga. Dibuat dengan tangan menggunakan canting, proses pembuatannya bisa memakan waktu berbulan-bulan untuk satu kain. Setiap batik tulis adalah karya seni unik karena goresan tangan yang tidak akan pernah identik satu sama lain.</p>
                <p><strong>Batik Cap</strong> dibuat menggunakan cap tembaga yang dicelupkan ke dalam malam panas dan ditekankan ke kain. Proses ini jauh lebih cepat dibandingkan batik tulis, namun tetap menghasilkan kualitas yang baik. Pola pada batik cap lebih seragam dan berulang.</p>
                <p><strong>Batik Printing</strong> adalah metode modern yang menggunakan mesin printing untuk menerapkan desain batik ke kain. Ini adalah proses tercepat dan termurah, meskipun sering dianggap kurang otentik dibandingkan dua jenis lainnya.</p>
                <p>Meskipun ketiga jenis batik ini memiliki tempat dan pasarnya sendiri, batik tulis tetap menjadi yang paling berharga dan dihormati karena nilai seni dan warisan budayanya.</p>',
                'user_id' => $author->id,
                'is_published' => true,
                'published_at' => now()->subDays(20),
                'slug' => Str::slug('Perbedaan Batik Tulis, Cap, dan Printing'),
                'featured_image' => 'blog-images/jenis-batik.jpg',
            ],
            [
                'title' => 'Merawat Kain Batik Agar Tahan Lama',
                'content' => '<p>Kain batik adalah investasi yang berharga dan dengan perawatan yang tepat, dapat bertahan selama bertahun-tahun. Berikut adalah beberapa tips untuk merawat kain batik Anda:</p>
                <p><strong>1. Cucian Tangan yang Lembut</strong><br>
                Selalu cuci batik Anda dengan tangan menggunakan air dingin dan deterjen lembut. Hindari menggosok kain terlalu keras karena dapat merusak serat dan warnanya.</p>
                <p><strong>2. Hindari Pemutih dan Deterjen Keras</strong><br>
                Bahan kimia yang keras dapat merusak warna dan motif batik. Gunakan deterjen khusus untuk kain halus atau bahkan sampo bayi untuk hasil terbaik.</p>
                <p><strong>3. Jangan Diperas</strong><br>
                Setelah mencuci, jangan memeras kain batik. Sebaiknya, tekan perlahan untuk mengeluarkan kelebihan air atau letakkan di atas handuk bersih dan gulung untuk menyerap air.</p>
                <p><strong>4. Keringkan di Tempat Teduh</strong><br>
                Jangan pernah menjemur batik di bawah sinar matahari langsung karena dapat menyebabkan warnanya pudar. Gantung di tempat teduh dengan sirkulasi udara yang baik.</p>
                <p><strong>5. Setrika dengan Hati-hati</strong><br>
                Gunakan pengaturan panas rendah hingga sedang saat menyetrika batik. Lebih baik lagi, setrika kain dalam keadaan masih sedikit lembab dan dari sisi belakang untuk melindungi motifnya.</p>
                <p><strong>6. Simpan dengan Benar</strong><br>
                Simpan batik Anda terlipat rapi di lemari atau laci dengan perlindungan dari ngengat. Hindari menggantung batik untuk waktu yang lama karena dapat menyebabkan kain meregang.</p>
                <p>Dengan perawatan yang tepat, kain batik Anda tidak hanya akan bertahan lama tetapi juga dapat menjadi warisan berharga untuk diteruskan ke generasi berikutnya.</p>',
                'user_id' => $admin->id,
                'is_published' => true,
                'published_at' => now()->subDays(10),
                'slug' => Str::slug('Merawat Kain Batik Agar Tahan Lama'),
                'featured_image' => 'blog-images/perawatan-batik.jpg',
            ],
            [
                'title' => 'Motif Batik Gumelem dan Filosofinya',
                'content' => '<p>Batik Gumelem dari Banjarnegara memiliki keunikan tersendiri yang tercermin dalam berbagai motif khasnya. Setiap motif tidak hanya indah secara visual tetapi juga mengandung filosofi mendalam yang mencerminkan kearifan lokal masyarakat Gumelem.</p>
                <p><strong>Motif Sekar Jagad Gumelem</strong><br>
                Motif ini menggambarkan keindahan dan keanekaragaman dunia dalam satu kesatuan. Pola-pola yang tampak seperti pulau-pulau kecil dengan berbagai ornamen di dalamnya melambangkan keberagaman alam semesta yang hidup berdampingan secara harmonis.</p>
                <p><strong>Motif Parang Gumelem</strong><br>
                Berbeda dengan motif parang dari daerah lain, Parang Gumelem memiliki sudut yang lebih halus dan lembut. Filosofinya adalah tentang perjuangan hidup dan ketahanan menghadapi rintangan, seperti ombak laut yang terus bergerak tanpa henti.</p>
                <p><strong>Motif Liong Gumelem</strong><br>
                Menunjukkan pengaruh budaya Tionghoa, motif ini menggambarkan naga yang melambangkan kekuatan, keberuntungan, dan kemakmuran. Kehadiran motif ini mencerminkan sejarah interaksi budaya di wilayah Gumelem.</p>
                <p><strong>Motif Semen Gumelem</strong><br>
                Motif ini menampilkan berbagai elemen alam seperti gunung, tumbuhan, dan burung. Filosofinya berkaitan dengan kesuburan, pertumbuhan, dan harapan akan kehidupan yang makmur.</p>
                <p><strong>Motif Wahyu Tumurun Gumelem</strong><br>
                Diyakini membawa berkah dan wahyu dari Yang Maha Kuasa, motif ini sering digunakan dalam upacara-upacara penting. Desainnya yang kompleks melambangkan harapan akan kedamaian dan pencerahan spiritual.</p>
                <p>Dengan memahami filosofi di balik motif-motif Batik Gumelem, kita tidak hanya mengapresiasi keindahan visualnya tetapi juga menghargai kekayaan budaya dan pemikiran yang telah diwariskan oleh para leluhur pengrajin batik Gumelem.</p>',
                'user_id' => $author->id,
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'slug' => Str::slug('Motif Batik Gumelem dan Filosofinya'),
                'featured_image' => 'blog-images/motif-gumelem.jpg',
            ],
            [
                'title' => 'Bagaimana Batik Gumelem Menjadi Identitas Banjarnegara',
                'content' => '<p>Batik Gumelem telah menjadi salah satu identitas budaya yang paling dikenal dari Kabupaten Banjarnegara. Artikel ini mengulas bagaimana seni batik tradisional ini berkembang dan menjadi kebanggaan masyarakat lokal.</p>
                <p><strong>Sejarah Perkembangan</strong><br>
                Batik Gumelem mulai berkembang pada masa Kadipaten Banyumas pada abad ke-17. Pada awalnya, batik ini hanya diproduksi untuk kalangan bangsawan dan upacara adat. Seiring waktu, produksi batik meluas ke masyarakat umum dan menjadi bagian dari kehidupan sehari-hari penduduk Gumelem.</p>
                <p><strong>Revitalisasi Batik Gumelem</strong><br>
                Pada awal tahun 2000-an, terjadi upaya revitalisasi Batik Gumelem yang hampir punah. Pemerintah daerah bersama pegiat budaya mendorong pelestarian dan pengembangan batik ini melalui berbagai program pelatihan dan pembinaan pengrajin.</p>
                <p><strong>Batik Sebagai Produk Unggulan Daerah</strong><br>
                Sejak diakuinya batik Indonesia oleh UNESCO pada 2009, Batik Gumelem semakin mendapat perhatian sebagai produk unggulan Banjarnegara. Kini, batik ini tidak hanya dikenal di dalam negeri tetapi juga mulai merambah pasar internasional.</p>
                <p><strong>Ekonomi Kreatif dan Pemberdayaan Masyarakat</strong><br>
                Industri Batik Gumelem telah menjadi motor penggerak ekonomi kreatif di Banjarnegara. Ratusan pengrajin, terutama perempuan, mendapatkan penghasilan dari membatik, menciptakan dampak ekonomi positif bagi masyarakat sekitar.</p>
                <p><strong>Batik Gumelem dalam Kehidupan Modern</strong><br>
                Batik Gumelem tidak lagi sekadar kain tradisional. Kini, motif-motifnya diaplikasikan pada berbagai produk fashion modern, aksesori, dan bahkan furnitur. Adaptasi ini membuat batik tetap relevan dalam gaya hidup kontemporer tanpa kehilangan nilai tradisionalnya.</p>
                <p>Sebagai produk budaya yang terus berkembang, Batik Gumelem membuktikan bahwa tradisi dan modernitas dapat berjalan beriringan, menciptakan identitas yang kuat namun tetap dinamis bagi Banjarnegara.</p>',
                'user_id' => $admin->id,
                'is_published' => false, // Draft
                'published_at' => null,
                'slug' => Str::slug('Bagaimana Batik Gumelem Menjadi Identitas Banjarnegara'),
                'featured_image' => 'blog-images/identitas-banjarnegara.jpg',
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::create($blog);
        }
    }
}
