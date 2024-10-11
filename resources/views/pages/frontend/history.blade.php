@extends('layouts.frontend')

@section('content')
    <!-- START: BREADCRUMB -->
    <section class="bg-gray-100 py-8 px-4">
        <div class="container mx-auto">
            <ul class="breadcrumb flex items-center space-x-2 text-sm">
                <li><a href="{{ route('index') }}" class="text-grey-700 hover:text-brown-600">Beranda</a></li>
                <li><span class="text-gray-500" aria-label="current-page">Sejarah Batik Gumelem</span></li>
            </ul>
        </div>
    </section>
    <!-- END: BREADCRUMB -->

    <!-- START: HISTORY HERO -->
    <section class="relative bg-brown-100 overflow-hidden">
        <div class="container mx-auto px-4 py-16 md:py-24">
            <div class="flex flex-col md:flex-row items-center">
                <div class="w-full md:w-1/2 text-center md:text-left mb-8 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold text-brown-800 leading-tight mb-4">
                        Sejarah Batik<br />Gumelem
                    </h1>
                    <p class="text-lg text-brown-600 mb-8">
                        Warisan budaya yang mempesona dari Banjarnegara, Jawa Tengah
                    </p>
                    <a href="#timeline" class="bg-brown-400 text-white hover:bg-brown-400 rounded-full px-8 py-3 inline-block transition duration-300">
                        Jelajahi Sejarah
                    </a>
                </div>
                <div class="w-full md:w-1/2 relative">
                    <img src="{{ url('/frontend/images/content/batik-history-800x500-2.png') }}" alt="Batik Gumelem" class="rounded-lg shadow-xl w-full h-auto">
                    <button class="absolute bottom-4 right-4 bg-brown-500 hover:bg-brown-600 text-white rounded-full p-4 transition duration-300 focus:outline-none" aria-label="Play video">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- END: HISTORY HERO -->

    <!-- START: HISTORY CONTENT -->
    <section class="bg-white py-16 px-4" id="timeline">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-12 text-brown-800">Perjalanan Batik Gumelem</h2>

            <!-- Timeline items -->
            <div class="space-y-16">
                <!-- Asal Usul -->
                <div class="flex flex-col md:flex-row items-center mb-16">
                    <div class="md:w-1/2 mb-8 md:mb-0 md:pr-8">
                        {{-- 700x500 --}}
                        <img src="{{ url('/frontend/images/content/batik-history-700x500-2.png') }}" alt="Asal Usul Batik Gumelem" class="rounded-lg shadow-lg w-full h-auto">
                    </div>
                    <div class="md:w-1/2">
                        <h3 class="text-2xl font-bold mb-4">Asal Usul</h3>
                        <p class="text-lg text-gray-700 mb-4">
                            Batik Gumelem lahir di tengah keindahan alam Desa Gumelem, Banjarnegara, pada abad ke-17. Saat itu, Gumelem menjadi bagian penting dari Kadipaten Banyumas, menciptakan lingkungan yang subur bagi perkembangan seni dan budaya.
                        </p>
                        <p class="text-lg text-gray-700">
                            Para pengrajin batik lokal, terinspirasi oleh keindahan alam sekitar dan kearifan lokal, mulai mengembangkan gaya dan motif khas yang kemudian dikenal sebagai Batik Gumelem. Setiap kain batik tidak hanya menjadi pakaian, tetapi juga menceritakan kisah sejarah dan budaya Gumelem, menjadikannya artefak budaya yang berharga.
                        </p>
                    </div>
                </div>

                <!-- Motif Khas -->
                <div class="flex flex-col md:flex-row-reverse items-center mb-16">
                    <div class="md:w-2/3 mb-8 md:mb-0 md:pl-8">
                        {{-- 800x500 --}}
                        <img src="{{ url('/frontend/images/content/batik-history-800x500-1.png') }}" alt="Motif Khas Batik Gumelem" class="rounded-lg shadow-lg w-full h-auto">
                    </div>
                    <div class="md:w-1/2">
                        <h3 class="text-2xl font-bold mb-4 mt-4">Motif Khas</h3>
                        <p class="text-lg text-gray-700 mb-4">
                            Batik Gumelem terkenal dengan motifnya yang kaya akan filosofi dan keindahan alam. Desain unik ini menggambarkan kearifan lokal Banjarnegara, menciptakan identitas yang khas. Beberapa motif ikonik meliputi:
                        </p>
                        <ul class="list-disc list-inside text-lg text-gray-700 mb-4">
                            <li><span class="font-bold">Gunungan:</span> Melambangkan kehidupan dan alam semesta</li>
                            <li><span class="font-bold">Sekar Jagad:</span> Menggambarkan keberagaman dunia</li>
                            <li><span class="font-bold">Udan Liris:</span> Simbol kesuburan dan harapan</li>
                        </ul>
                        <p class="text-lg text-gray-700">
                            Setiap motif tidak hanya indah secara visual, tetapi juga sarat akan makna dan nilai-nilai kehidupan.
                        </p>
                    </div>
                </div>

                <!-- Teknik Pembuatan -->
                <div class="flex flex-col md:flex-row items-center mb-16">
                    <div class="md:w-1/2 mb-8 md:mb-0 md:pr-8">
                        {{-- 700x500 --}}
                        <img src="{{ url('/frontend/images/content/batik-history-700x500-2.png') }}" alt="Teknik Pembuatan Batik Gumelem" class="rounded-lg shadow-lg w-full h-auto">
                    </div>
                    <div class="md:w-1/2">
                        <h3 class="text-2xl font-bold mb-4">Teknik Pembuatan</h3>
                        <p class="text-lg text-gray-700 mb-4">
                            Proses pembuatan Batik Gumelem adalah perpaduan antara seni dan ketekunan, menggunakan teknik tradisional yang diwariskan secara turun-temurun. Teknik utama yang digunakan meliputi:
                        </p>
                        <ul class="list-disc list-inside text-lg text-gray-700 mb-4">
                            <li><span class="font-bold">Batik Tulis:</span> Proses menggambar motif dengan canting</li>
                            <li><span class="font-bold">Batik Cap:</span> Menggunakan cap tembaga untuk membuat pola</li>
                        </ul>
                        <p class="text-lg text-gray-700">
                            Pewarnaan tradisional menggunakan bahan-bahan alami dari tumbuhan lokal, menghasilkan warna-warna khas yang lembut, tahan lama, dan mempesona. Penggunaan pewarna alami ini tidak hanya menghasilkan warna yang unik, tetapi juga mencerminkan komitmen terhadap praktik pembuatan batik yang ramah lingkungan.
                        </p>
                    </div>
                </div>

                <!-- Pelestarian dan Perkembangan -->
                <div class="flex flex-col-reverse md:flex-row items-center mb-16">
                    <div class="w-full md:w-1/2 mt-8 md:mt-0 md:pr-8">
                        <h3 class="text-2xl font-bold mb-4">Pelestarian dan Perkembangan</h3>
                        <p class="text-lg text-gray-700 mb-4">
                            Meskipun berakar pada tradisi, Batik Gumelem terus berkembang dan beradaptasi dengan zaman. Para pengrajin lokal berusaha melestarikan teknik tradisional sambil mengeksplorasi inovasi dalam desain dan aplikasi.
                        </p>
                        <p class="text-lg text-gray-700">
                            Upaya pelestarian melibatkan pelatihan generasi muda, pameran budaya, dan kolaborasi dengan desainer modern. Hal ini memastikan bahwa Batik Gumelem tetap relevan dan dihargai sebagai warisan budaya yang hidup.
                        </p>
                    </div>
                    <div class="w-full md:w-1/2">
                        {{-- 700x500 --}}
                        <img src="{{ url('/frontend/images/content/batik-history-700x500-3.png') }}" alt="Pelestarian Batik Gumelem" class="rounded-lg shadow-lg w-full h-auto">
                    </div>
                </div>

                <!-- START: PROSES PEMBUATAN BATIK GUMELEM -->
                <section class="py-16 bg-gray-100">
                    <div class="container mx-auto px-4">
                        <h2 class="text-4xl font-bold text-center text-brown-600 mb-8">Proses Pembuatan Batik Gumelem</h2>
                        <p class="text-xl text-center text-gray-600 mb-12 max-w-3xl mx-auto">
                            Mari kita jelajahi langkah demi langkah proses pembuatan Batik Gumelem yang penuh ketelitian dan kearifan.
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <div class="text-brown-400 mb-4">
                                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-center mb-2">1. Pembuatan Pola</h3>
                                <p class="text-gray-600 text-center">
                                    Desain motif khas Gumelem digambar dengan pensil di atas kain mori.
                                </p>
                            </div>

                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <div class="text-brown-400 mb-4">
                                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-center mb-2">2. Pencantingan</h3>
                                <p class="text-gray-600 text-center">
                                    Lilin malam dioleskan menggunakan canting, mengikuti pola yang telah dibuat.
                                </p>
                            </div>

                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <div class="text-brown-400 mb-4">
                                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-center mb-2">3. Pewarnaan</h3>
                                <p class="text-gray-600 text-center">
                                    Kain dicelup dalam larutan pewarna alami dari tumbuhan lokal Gumelem.
                                </p>
                            </div>

                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <div class="text-brown-400 mb-4">
                                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-center mb-2">4. Pelorodan</h3>
                                <p class="text-gray-600 text-center">
                                    Proses menghilangkan lilin malam dengan air panas, mengungkap motif indah.
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            {{-- 400x200 --}}
                            <img src="{{ url('/frontend/images/content/batik-history-400x200-1.png') }}" alt="Pembuatan Pola" class="rounded-lg shadow-md w-full h-48 object-cover">
                            <img src="{{ url('/frontend/images/content/batik-history-400x200-3.png') }}" alt="Pencantingan" class="rounded-lg shadow-md w-full h-48 object-cover">
                            <img src="{{ url('/frontend/images/content/batik-history-400x200-4.png') }}" alt="Pewarnaan" class="rounded-lg shadow-md w-full h-48 object-cover">
                            <img src="{{ url('/frontend/images/content/batik-history-400x200-5.png') }}" alt="Pelorodan" class="rounded-lg shadow-md w-full h-48 object-cover">
                        </div>
                    </div>
                </section>
                <!-- END: PROSES PEMBUATAN BATIK GUMELEM -->

                <div class="mt-16 text-center">
                    <a href="{{ route('products') }}" class="bg-brown-400 text-white hover:bg-black rounded-full px-8 py-3 inline-block transition duration-300">
                        Lihat Semua Koleksi Batik Gumelem
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- END: HISTORY CONTENT -->
@endsection

@push('addon-script')
<script>
    // Add any additional JavaScript here
</script>
@endpush
