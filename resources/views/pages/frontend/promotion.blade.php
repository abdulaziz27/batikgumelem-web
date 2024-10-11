@extends('layouts.frontend')

@section('content')
    <!-- START: BREADCRUMB -->
    <section class="bg-gray-100 py-8 px-4">
        <div class="container mx-auto">
            <ul class="breadcrumb flex items-center space-x-2 text-sm">
                <li><a href="{{ route('index') }}" class="text-grey-700 hover:text-brown-600">Beranda</a></li>
                <li><span class="text-gray-500">Promosi</span></li>
            </ul>
        </div>
    </section>
    <!-- END: BREADCRUMB -->

    <!-- START: PROMOTION HERO -->
    <section class="bg-brown-100 py-12 px-4">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-brown-800 mb-4">Promosi Spesial</h1>
            <p class="text-gray-400 text-lg mt-2 max-w-2xl mx-auto">
                Temukan penawaran terbaik untuk produk Batik Gumelem kami
            </p>
        </div>
    </section>
    <!-- END: PROMOTION HERO -->

    <!-- START: PROMOTION CARDS -->
    <section class="py-16 px-4 bg-white">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Promo Card 1 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    {{-- <img src="https://via.placeholder.com/400x250" alt="Promo Lebaran" class="w-full h-64 object-cover"> --}}
                    <img src="/frontend/images/content/batik-history-400x200-1.png" alt="Promo Lebaran" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-brown-800 mb-2">Promo Lebaran</h3>
                        <p class="text-gray-600 mb-4">Dapatkan diskon hingga 30% untuk pembelian batik selama bulan Ramadhan</p>
                        <span class="inline-block bg-yellow-400 text-yellow-800 text-sm font-semibold px-3 py-1 rounded-full mb-4">Diskon 30%</span>
                        <div class="bg-gray-100 p-3 rounded-md relative">
                            <p class="text-sm text-gray-600 mb-1">Kode Voucher:</p>
                            <p class="text-lg font-bold text-brown-800" id="voucher1">LEBARAN30</p>
                            <button onclick="copyVoucher('voucher1')" class="absolute right-2 bottom-2 bg-brown-500 text-white px-2 py-1 rounded text-xs hover:bg-brown-600 transition duration-300">Salin</button>
                        </div>
                    </div>
                </div>

                <!-- Promo Card 2 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="/frontend/images/content/banner-homepage-1-full.png" alt="Promo Hari Batik Nasional" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-brown-800 mb-2">Hari Batik Nasional</h3>
                        <p class="text-gray-600 mb-4">Rayakan Hari Batik Nasional dengan diskon spesial untuk semua produk</p>
                        <span class ="inline-block bg-yellow-400 text-yellow-800 text-sm font-semibold px-3 py-1 rounded-full mb-4">Diskon 20%</span>
                        <div class="bg-gray-100 p-3 rounded-md relative">
                            <p class="text-sm text-gray-600 mb-1">Kode Voucher:</p>
                            <p class="text-lg font-bold text-brown-800" id="voucher2">BATIKNASIONAL20</p>
                            <button onclick="copyVoucher('voucher2')" class="absolute right-2 bottom-2 bg-brown-500 text-white px-2 py-1 rounded text-xs hover:bg-brown-600 transition duration-300">Salin</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END: PROMOTION CARDS -->

    <script>
        function copyVoucher(id) {
            var voucher = document.getElementById(id);
            var range = document.createRange();
            range.selectNode(voucher);
            window.getSelection().addRange(range);
            document.execCommand("copy");
            alert("Kode voucher telah disalin!");
        }
    </script>
@endsection
