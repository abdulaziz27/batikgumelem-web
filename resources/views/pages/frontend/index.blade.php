@extends('layouts.frontend')

@section('content')

   <!-- START: HERO -->
   <section class="flex items-center hero">
      <div
        class="w-full absolute z-20 inset-0 md:relative md:w-1/2 text-center flex flex-col justify-center hero-caption"
      >
        <h1 class="text-3xl md:text-5xl leading-tight font-semibold">
            Batik Original
              <br class="" />Handmade
        </h1>
        <h2 class="px-8 text-base md:px-0 md:text-lg my-6 tracking-wide">
            Kami menyediakan batik buatan tangan
          <br class="hidden lg:block" />para pengrajin Desa Gumelem
        </h2>
        <div>
          <a
            href="#browse-the-room"
            class="bg-brown-400 text-white hover:bg-black rounded-full px-8 py-3 mt-4 inline-block flex-none transition duration-200"
            >Explore Now</a
          >
        </div>
      </div>
      <div class="w-full inset-0 md:relative md:w-1/2">
        <div class="relative hero-image">
          <div class="overlay inset-0 bg-black opacity-35 z-10"></div>
          <div class="overlay right-0 bottom-0 md:inset-0">
            <button
                class="video hero-cta focus:outline-none z-30 modal-trigger"
                style="background-color: #533529; width: 75px; height: 75px;"
                data-content='<div style="width: 90vw; height: 90vh; max-width: 1200px; max-height: 800px;" class="w-screen h-screen md:w-4/5 md:h-4/5 max-w-6xl max-h-6xl mx-auto relative z-100">
                    <div class="absolute inset-0">
                    <iframe
                        width="100%"
                        height="100%"
                        src="https://www.youtube.com/embed/7-S-CknPaL4"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                    ></iframe>
                    </div>
                </div>'
            ></button>
          </div>
          <img
            src="/frontend/images/content/banner-homepage-1-full.png"
            alt="hero 1"
            class="absolute inset-0 md:relative w-full h-full object-cover object-center"
          />
        </div>
      </div>
    </section>
    <!-- END: HERO -->

    <!-- START: BROWSE THE PRODUCT -->
    <section class="flex bg-gray-100 py-16 px-4" id="browse-the-room">
        <div class="container mx-auto">
            <div class="text-center mb-12">
                <h3 class="text-3xl capitalize font-semibold">
                    Produk <br class="sm:hidden" /> Populer
                </h3>
                <p class="text-gray-400 text-lg mt-2">
                    Kualitas terbaik dan pilihan batik original yang tersedia saat ini.
                </p>
            </div>
            <div class="flex flex-wrap -mx-4">
                @foreach ($products as $product)
                <div class="px-4 mb-8 relative">
                <div class="card group">
                    <div
                    class="rounded-xl overflow-hidden card-shadow relative"
                    style="width: 287px; height: 386px"
                    >
                    <div
                        class="absolute opacity-0 group-hover:opacity-100 transition duration-200 flex items-center justify-center w-full h-full bg-black bg-opacity-35"
                    >
                        <div
                        class="bg-white text-black rounded-full w-16 h-16 flex items-center justify-center"
                        >
                        <svg
                            class="fill-current"
                            width="43"
                            height="24"
                            viewBox="0 0 43 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                            d="M41.6557 10.0065C39.2794 6.95958 36.2012 4.43931 32.7542 2.71834C29.2355 0.961548 25.4501 0.0500333 21.4985 0.00223289C21.3896 -0.000744296 20.9526 -0.000744296 20.8438 0.00223289C16.8923 0.050116 13.1068 0.961548 9.58807 2.71834C6.14106 4.43931 3.06307 6.9595 0.686613 10.0065C-0.228871 11.1802 -0.228871 12.8198 0.686613 13.9935C3.06299 17.0404 6.14106 19.5607 9.58807 21.2817C13.1068 23.0385 16.8922 23.95 20.8438 23.9978C20.9526 24.0007 21.3896 24.0007 21.4985 23.9978C25.45 23.9499 29.2355 23.0385 32.7542 21.2817C36.2012 19.5607 39.2793 17.0405 41.6557 13.9935C42.5712 12.8196 42.5712 11.1802 41.6557 10.0065ZM10.3576 19.7406C7.13892 18.1335 4.26445 15.7799 2.04487 12.9341C1.61591 12.3841 1.61591 11.6159 2.04487 11.0659C4.26436 8.22009 7.13883 5.86646 10.3576 4.25944C11.2717 3.80311 12.2053 3.40846 13.1561 3.07436C10.71 5.27317 9.16886 8.45975 9.16886 12C9.16886 15.5403 10.7101 18.7272 13.1564 20.9259C12.2056 20.5918 11.2718 20.197 10.3576 19.7406ZM21.1712 22.2798C15.5028 22.2798 10.8913 17.6683 10.8913 11.9999C10.8913 6.33148 15.5028 1.72007 21.1712 1.72007C26.8396 1.72007 31.4511 6.33156 31.4511 12C31.4511 17.6684 26.8396 22.2798 21.1712 22.2798ZM40.2976 12.9341C38.0781 15.7798 35.2036 18.1335 31.9849 19.7405C31.0718 20.1963 30.1388 20.5892 29.1892 20.923C31.6336 18.7243 33.1736 15.5387 33.1736 11.9999C33.1736 8.45918 31.6321 5.27218 29.1856 3.07336C30.1366 3.40755 31.0705 3.80269 31.9849 4.25928C35.2036 5.86629 38.0781 8.21993 40.2976 11.0657C40.7265 11.6158 40.7265 12.384 40.2976 12.9341Z"
                            />
                            <path
                            d="M21.1712 7.60071C18.7454 7.60071 16.772 9.57417 16.772 11.9999C16.772 14.4257 18.7454 16.3991 21.1712 16.3991C23.5969 16.3991 25.5704 14.4257 25.5704 11.9999C25.5705 9.57417 23.597 7.60071 21.1712 7.60071ZM21.1712 14.6767C19.6952 14.6767 18.4944 13.476 18.4944 11.9999C18.4944 10.5239 19.6951 9.32318 21.1712 9.32318C22.6471 9.32318 23.8479 10.5239 23.8479 11.9999C23.848 13.476 22.6471 14.6767 21.1712 14.6767Z"
                            />
                        </svg>
                    </div>
                </div>
                @php
                    $imageUrl = $product->galleries->first()->url ?? null;
                    $imageUrl = $imageUrl ? (str_contains($imageUrl, 'storage') ? asset($imageUrl) : asset('storage/' . $imageUrl)) : 'data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==';
                @endphp
                <img
                    src="{{ $imageUrl }}"
                    alt="{{ $product->name }}"
                    class="w-full h-full object-cover object-center"
                />
                </div>
                <h5 class="text-lg font-semibold mt-4">{{ $product->name }}</h5>
                <span class="">{{ number_format($product->price) }}</span>
                <a href="{{ route('details', $product->slug) }}" class="stretched-link">
                <!-- fake children -->
                </a>
            </div>
            </div>
            @endforeach
        </div>
        </div>
    </section>
    <!-- END: BROWSE THE PRODUCT -->

    <!-- START: CALL TO ACTION DAN CARA PEMBELIAN -->
    <section class="py-16">
        <div class="container mx-auto px-4">

            <div class="text-center mb-12">
                <h3 class="text-4xl capitalize font-semibold text-center mb-6">
                    Miliki Batik Gumelem Sekarang
                </h3>
                <p class="text-gray-400 text-lg">
                    Temukan keindahan Batik Gumelem dan jadikan bagian dari koleksi Anda.
                </p>
            </div>

            <!-- Tata Cara Pembelian -->
            <div class="max-w-4xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex items-center mb-4">
                            <span class="text-brown-500 text-3xl font-bold mr-4">1</span>
                            <h4 class="text-xl font-semibold">Pilih Produk</h4>
                        </div>
                        <p class="text-gray-600">
                            Jelajahi katalog kami dan pilih batik yang sesuai dengan selera Anda.
                        </p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex items-center mb-4">
                            <span class="text-brown-500 text-3xl font-bold mr-4">2</span>
                            <h4 class="text-xl font-semibold">Tambahkan ke Keranjang</h4>
                        </div>
                        <p class="text-gray-600">
                            Klik tombol "Tambah ke Keranjang" pada produk yang Anda inginkan.
                        </p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex items-center mb-4">
                            <span class="text-brown-500 text-3xl font-bold mr-4">3</span>
                            <h4 class="text-xl font-semibold">Proses Checkout</h4>
                        </div>
                        <p class="text-gray-600">
                            Isi formulir pengiriman dan pilih metode pembayaran yang Anda inginkan.
                        </p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex items-center mb-4">
                            <span class="text-brown-500 text-3xl font-bold mr-4">4</span>
                            <h4 class="text-xl font-semibold">Tunggu Pengiriman</h4>
                        </div>
                        <p class="text-gray-600">
                            Kami akan memproses pesanan Anda dan mengirimkannya ke alamat yang ditentukan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END: CALL TO ACTION DAN CARA PEMBELIAN -->

@endsection
