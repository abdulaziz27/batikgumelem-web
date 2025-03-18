@extends('layouts.frontend')

@section('content')
    <!-- START: HERO -->
    <section class="flex items-center hero">
        <div class="w-full absolute z-20 inset-0 md:relative md:w-1/2 text-center flex flex-col justify-center hero-caption">
            <h1 class="text-3xl md:text-5xl leading-tight font-semibold">
                Batik Original
                <br class="" />Handmade
            </h1>
            <h2 class="px-8 text-base md:px-0 md:text-lg my-6 tracking-wide">
                Kami menyediakan batik buatan tangan
                <br class="hidden lg:block" />para pengrajin Desa Gumelem
            </h2>
            <div>
                <a href="#browse-the-room"
                    class="bg-brown-400 text-white hover:bg-black rounded-full px-8 py-3 mt-4 inline-block flex-none transition duration-200">Explore
                    Now</a>
            </div>
        </div>
        <div class="w-full inset-0 md:relative md:w-1/2">
            <div class="relative hero-image">
                <div class="overlay inset-0 bg-black opacity-35 z-10"></div>
                <div class="overlay right-0 bottom-0 md:inset-0">
                    <button class="video hero-cta focus:outline-none z-30 modal-trigger"
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
                </div>'></button>
                </div>
                <img src="/frontend/images/content/banner-homepage-1-full.png" alt="hero 1"
                    class="absolute inset-0 md:relative w-full h-full object-cover object-center" />
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
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <div class="px-4 mb-8 relative">
                        <div class="card group">
                            <div class="rounded-xl overflow-hidden card-shadow relative"
                                style="width: 287px; height: 386px">
                                <div
                                    class="absolute opacity-0 group-hover:opacity-100 transition duration-200 flex items-center justify-center w-full h-full bg-black bg-opacity-35 z-10">
                                    <div class="flex space-x-2">
                                        <!-- View Details Icon -->
                                        <a href="{{ route('details', $product->slug) }}"
                                            class="bg-white text-black rounded-full w-12 h-12 flex items-center justify-center hover:bg-gray-100 transition duration-200 z-20">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </a>

                                        <!-- Wishlist Button -->
                                        @auth
                                            <form class="wishlist-form" action="{{ route('wishlist.toggle', $product->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="button" onclick="submitWishlistForm(this)"
                                                    class="wishlist-button bg-white rounded-full w-12 h-12 flex items-center justify-center hover:bg-gray-100 transition duration-200 z-20 {{ Auth::user()->hasInWishlist($product->id) ? 'text-red-600' : 'text-black' }}">
                                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}"
                                                class="bg-white text-black hover:text-red-600 rounded-full w-12 h-12 flex items-center justify-center hover:bg-gray-100 transition duration-200 z-20">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                </svg>
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                                @php
                                    $imageUrl = $product->galleries->isNotEmpty()
                                        ? $product->galleries->first()->url
                                        : null;

                                    $imageUrl = $imageUrl
                                        ? (str_contains($imageUrl, 'storage')
                                            ? asset($imageUrl)
                                            : asset('storage/' . ltrim($imageUrl, '/')))
                                        : 'data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==';
                                @endphp
                                <img src="{{ $imageUrl }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-cover object-center" />
                            </div>
                            <div class="mt-4">
                                <h5 class="text-lg font-semibold">{{ $product->name }}</h5>
                                <div class="flex justify-between items-center mt-2">
                                    <span>IDR {{ number_format($product->price) }}</span>

                                    <!-- Stock & Rating -->
                                    <div class="flex items-center">
                                        @if ($product->stock > 0)
                                            <span class="text-xs text-green-600 mr-2">In Stock</span>
                                        @else
                                            <span class="text-xs text-red-600 mr-2">Out of Stock</span>
                                        @endif

                                        <div class="flex items-center">
                                            <span class="text-yellow-400 text-sm">★</span>
                                            <span
                                                class="text-xs text-gray-600 ml-1">{{ number_format($product->average_rating, 1) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Clickable area for the entire card -->
                            <a href="{{ route('details', $product->slug) }}" class="absolute inset-0 z-0">
                                <!-- Empty space for clickable area -->
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- View More Products Button -->
            <div class="flex justify-center mt-8">
                <a href="{{ route('products') }}"
                    class="bg-brown-400 text-white hover:bg-black transition duration-200 rounded-full px-8 py-3 inline-block">
                    View All Products
                </a>
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

<!-- Script for wishlist functionality -->
@push('addon-script')
<script>
    // Wishlist form submission function
    function submitWishlistForm(button) {
        event.preventDefault();
        event.stopPropagation();

        const form = button.closest('.wishlist-form');
        const formData = new FormData(form);

        // Set loading state
        button.disabled = true;

        // Send form data via fetch
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Update the button state based on the server response
            if (data.in_wishlist) {
                button.classList.add('text-red-600');
                button.classList.remove('text-black');
            } else {
                button.classList.remove('text-red-600');
                button.classList.add('text-black');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        })
        .finally(() => {
            // Re-enable the button
            button.disabled = false;
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Ensure overlay buttons correctly stop event propagation
        document.querySelectorAll('.card .z-20').forEach(element => {
            element.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });
    });
</script>
@endpush
