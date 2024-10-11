@extends('layouts.frontend')

@section('content')
    <!-- START: BREADCRUMB -->
    <section class="bg-gray-100 py-8 px-4">
        <div class="container mx-auto">
            <ul class="breadcrumb flex items-center space-x-2 text-sm">
                <li><a href="{{ route('index') }}" class="text-brown-400 hover:text-brown-600">Beranda</a></li>
                <li><span class="text-gray-500">Syarat dan Ketentuan</span></li>
            </ul>
        </div>
    </section>
    <!-- END: BREADCRUMB -->

    <!-- START: SYARAT DAN KETENTUAN -->
    <section class="bg-white py-16 px-4">
        <div class="container mx-auto">
            <div class="text-center mb-12">
                <h1 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Syarat dan Ketentuan</h1>
                <p class="text-gray-400 text-lg mt-2 max-w-2xl mx-auto">
                    Harap baca syarat dan ketentuan berikut dengan seksama sebelum melakukan pembelian.
                </p>
            </div>

            <div class="max-w-4xl mx-auto space-y-8">
                <!-- Syarat Umum -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">1. Syarat Umum</h2>
                    <p class="mt-4 text-gray-600">
                        Dengan mengakses situs web kami dan membeli produk kami, Anda setuju untuk mematuhi dan terikat oleh syarat dan ketentuan berikut. Syarat ini berlaku untuk semua pengunjung, pengguna, dan pelanggan situs web.
                    </p>
                </div>

                <!-- Produk Batik -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">2. Produk Batik</h2>
                    <p class="mt-4 text-gray-600">
                        Produk Batik kami dibuat secara handmade dan unik. Mungkin ada variasi kecil dalam warna, pola, dan tekstur. Variasi ini tidak dianggap sebagai cacat, tetapi merupakan ciri khas dari kerajinan tradisional.
                    </p>
                </div>

                <!-- Kebijakan Pembelian -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">3. Kebijakan Pembelian</h2>
                    <p class="mt-4 text-gray-600">
                        Semua pembelian yang dilakukan melalui situs web kami tergantung pada ketersediaan produk. Kami berhak membatasi jumlah atau menolak pesanan apa pun yang Anda tempatkan kepada kami. Harga produk dapat berubah tanpa pemberitahuan.
                    </p>
                </div>

                <!-- Kebijakan Pengembalian dan Pengembalian Dana -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">4. Kebijakan Pengembalian dan Pengembalian Dana</h2>
                    <p class="mt-4 text-gray-600">
                        Kami menerima pengembalian dalam waktu 14 hari setelah pengiriman untuk barang cacat atau yang salah. Barang harus dalam kondisi tidak terpakai, dengan label asli, dan dalam kemasan aslinya. Untuk memulai pengembalian, silakan hubungi tim layanan pelanggan kami.
                    </p>
                    <p class="mt-4 text-gray-600">
                        Pengembalian dana akan diproses setelah barang yang dikembalikan diperiksa. Harap dicatat bahwa biaya pengiriman tidak dapat dikembalikan, dan pelanggan bertanggung jawab atas biaya pengiriman pengembalian kecuali pengembalian disebabkan oleh kesalahan kami.
                    </p>
                </div>

                <!-- Hukum yang Berlaku -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">5. Hukum yang Berlaku</h2>
                    <p class="mt-4 text-gray-600">
                        Syarat dan ketentuan ini diatur dan ditafsirkan sesuai dengan hukum negara tempat bisnis kami beroperasi. Setiap perselisihan yang timbul dari syarat ini akan tunduk pada yurisdiksi eksklusif pengadilan di lokasi kami.
                    </p>
                </div>
            </div>

            <!-- Bagian Kontak Layanan Pelanggan -->
            <div class="mt-12 text-center">
                <p class="text-gray-600">Untuk pertanyaan lebih lanjut, jangan ragu untuk menghubungi kami.</p>
                <a href="{{ url('https://wa.me/6285211553430?') }}" target="_blank"
                    class="mt-2 inline-block px-6 py-3 bg-brown-400 text-white rounded hover:bg-black transition duration-300">
                    Hubungi Layanan Pelanggan
                </a>
            </div>
        </div>
    </section>
    <!-- END: SYARAT DAN KETENTUAN -->
@endsection

@push('addon-script')
<script>
    // Tambahkan JavaScript tambahan di sini jika diperlukan
</script>
@endpush
