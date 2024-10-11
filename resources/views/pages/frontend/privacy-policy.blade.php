@extends('layouts.frontend')

@section('content')
    <!-- START: BREADCRUMB -->
    <section class="bg-gray-100 py-8 px-4">
        <div class="container mx-auto">
            <ul class="breadcrumb flex items-center space-x-2 text-sm">
                <li><a href="{{ route('index') }}" class="text-brown-400 hover:text-brown-600">Beranda</a></li>
                <li><span class="text-gray-500">Kebijakan Privasi</span></li>
            </ul>
        </div>
    </section>
    <!-- END: BREADCRUMB -->

    <!-- START: KEBIJAKAN PRIVASI -->
    <section class="bg-white py-16 px-4">
        <div class="container mx-auto">
            <div class="text-center mb-12">
                <h1 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Kebijakan Privasi</h1>
                <p class="text-gray-400 text-lg mt-2 max-w-2xl mx-auto">
                    Kami menghargai privasi Anda. Bacalah kebijakan ini untuk memahami bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi Anda.
                </p>
            </div>

            <div class="max-w-4xl mx-auto space-y-8">
                <!-- Pengumpulan Informasi -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">1. Pengumpulan Informasi</h2>
                    <p class="mt-4 text-gray-600">
                        Kami mengumpulkan informasi yang Anda berikan secara langsung, seperti saat Anda membuat akun, melakukan pembelian, atau menghubungi layanan pelanggan. Informasi ini termasuk nama, alamat email, nomor telepon, dan rincian pembayaran.
                    </p>
                    <p class="mt-4 text-gray-600">
                        Kami juga dapat mengumpulkan informasi secara otomatis saat Anda mengunjungi situs kami, seperti alamat IP, jenis perangkat, dan data interaksi dengan situs web.
                    </p>
                </div>

                <!-- Penggunaan Informasi -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">2. Penggunaan Informasi</h2>
                    <p class="mt-4 text-gray-600">
                        Informasi yang kami kumpulkan digunakan untuk memproses pesanan, menyediakan layanan pelanggan, dan meningkatkan pengalaman pengguna di situs kami. Kami juga menggunakan informasi Anda untuk mengirimkan pembaruan terkait produk atau layanan, promosi, dan komunikasi terkait lainnya.
                    </p>
                </div>

                <!-- Perlindungan Data -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">3. Perlindungan Data</h2>
                    <p class="mt-4 text-gray-600">
                        Kami menjaga keamanan informasi pribadi Anda dengan menerapkan langkah-langkah teknis dan organisatoris yang sesuai. Data Anda dienkripsi selama transmisi dan disimpan dalam server yang aman. Namun, harap dicatat bahwa tidak ada metode transmisi data di internet yang 100% aman.
                    </p>
                </div>

                <!-- Pembagian Informasi kepada Pihak Ketiga -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">4. Pembagian Informasi kepada Pihak Ketiga</h2>
                    <p class="mt-4 text-gray-600">
                        Kami tidak membagikan informasi pribadi Anda kepada pihak ketiga, kecuali yang diperlukan untuk memproses pesanan, seperti penyedia layanan pembayaran atau pengiriman. Selain itu, kami dapat membagikan informasi jika diwajibkan oleh hukum atau untuk melindungi hak kami.
                    </p>
                </div>

                <!-- Hak-Hak Anda -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">5. Hak-Hak Anda</h2>
                    <p class="mt-4 text-gray-600">
                        Anda berhak untuk mengakses, memperbarui, atau menghapus informasi pribadi Anda. Jika Anda ingin menggunakan hak-hak ini, silakan hubungi kami melalui halaman Kontak. Kami akan menanggapi permintaan Anda sesuai dengan peraturan perlindungan data yang berlaku.
                    </p>
                </div>

                <!-- Cookies dan Teknologi Pelacakan -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">6. Cookies dan Teknologi Pelacakan</h2>
                    <p class="mt-4 text-gray-600">
                        Kami menggunakan cookies dan teknologi pelacakan lainnya untuk mengumpulkan informasi tentang aktivitas Anda di situs kami. Cookies membantu kami memahami preferensi pengguna, meningkatkan kinerja situs, dan memberikan pengalaman yang dipersonalisasi.
                    </p>
                    <p class="mt-4 text-gray-600">
                        Anda dapat mengatur peramban Anda untuk menolak cookies, tetapi hal ini dapat mempengaruhi cara kerja situs kami.
                    </p>
                </div>

                <!-- Perubahan Kebijakan Privasi -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">7. Perubahan Kebijakan Privasi</h2>
                    <p class="mt-4 text-gray-600">
                        Kami dapat memperbarui kebijakan privasi ini dari waktu ke waktu. Kami akan memberi tahu Anda tentang perubahan material dengan mengirimkan pemberitahuan ke alamat email Anda atau dengan memposting pemberitahuan di situs kami.
                    </p>
                </div>

                <!-- Kontak Layanan Pelanggan -->
                <div class="mt-12 text-center">
                    <p class="text-gray-600">Jika Anda memiliki pertanyaan lebih lanjut mengenai kebijakan privasi ini, silakan hubungi kami.</p>
                    <a href="{{ url('https://api.whatsapp.com/') }}" target="_blank"
                        class="mt-2 inline-block px-6 py-3 bg-brown-400 text-white rounded hover:bg-black transition duration-300">
                        Hubungi Layanan Pelanggan
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- END: KEBIJAKAN PRIVASI -->
@endsection

@push('addon-script')
<script>
    // Tambahkan JavaScript tambahan di sini jika diperlukan
</script>
@endpush
