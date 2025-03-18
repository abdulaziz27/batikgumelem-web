@extends('layouts.frontend')

@section('content')
    <!-- START: BREADCRUMB -->
    <section class="bg-gray-100 py-8 px-4">
        <div class="container mx-auto">
          <ul class="breadcrumb flex items-center space-x-2 text-sm">
              <li><a href="{{ route('index') }}" class="text-grey-700 hover:text-brown-600">Beranda</a></li>
              <li><span class="text-gray-500" aria-label="current-page">Wishlist</span></li>
          </ul>
        </div>
    </section>
    <!-- END: BREADCRUMB -->

    <!-- START: WISHLIST -->
    <section class="md:py-16">
        <div class="container mx-auto px-4">
            <div class="flex -mx-4 flex-wrap">
                <div class="w-full px-4 mb-4" id="wishlist">
                    <div class="flex flex-start mb-4 mt-8 pb-3 border-b border-gray-200">
                        <h3 class="text-2xl">My Wishlist</h3>
                    </div>

                    @if($wishlists->count() > 0)
                        <div class="border-b border-gray-200 mb-4 hidden md:block">
                            <div class="flex flex-start items-center pb-2 -mx-4">
                                <div class="px-4 flex-none">
                                    <div class="" style="width: 90px">
                                        <h6>Photo</h6>
                                    </div>
                                </div>
                                <div class="px-4 w-5/12">
                                    <div class="">
                                        <h6>Product</h6>
                                    </div>
                                </div>
                                <div class="px-4 w-5/12">
                                    <div class="">
                                        <h6>Price</h6>
                                    </div>
                                </div>
                                <div class="px-4 w-2/12">
                                    <div class="text-center">
                                        <h6>Action</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @foreach ($wishlists as $wishlist)
                            <div class="flex flex-start flex-wrap items-center mb-4 -mx-4 hover:bg-gray-100 rounded-lg p-2 transition duration-150 ease-in-out">
                                <div class="px-4 flex-none">
                                    <div class="" style="width: 90px; height: 90px">
                                        @php
                                            $imageUrl = $wishlist->product->galleries->isNotEmpty()
                                                ? $wishlist->product->galleries->first()->url
                                                : null;

                                            $imageUrl = $imageUrl
                                                ? (str_contains($imageUrl, 'storage') ? asset($imageUrl) : asset('storage/' . ltrim($imageUrl, '/')))
                                                : 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mN88B8AAsUB4ZtvXtIAAAAASUVORK5CYII=';
                                        @endphp
                                        <img
                                            src="{{ $imageUrl }}"
                                            alt="{{ $wishlist->product->name }}"
                                            class="object-cover rounded-xl w-full h-full"
                                        />
                                    </div>
                                </div>
                                <div class="px-4 w-auto flex-1 md:w-5/12">
                                    <div class="">
                                        <h6 class="font-semibold text-lg md:text-xl leading-8">
                                            <a href="{{ route('details', $wishlist->product->slug) }}" class="hover:underline">
                                                {{ $wishlist->product->name }}
                                            </a>
                                        </h6>

                                        <!-- Stock Indicator -->
                                        @if($wishlist->product->stock > 0)
                                            <span class="text-green-600 text-sm">In Stock</span>
                                        @else
                                            <span class="text-red-600 text-sm">Out of Stock</span>
                                        @endif

                                        <div class="flex items-center mt-1">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= round($wishlist->product->average_rating))
                                                    <span class="text-yellow-400 text-sm">★</span>
                                                @else
                                                    <span class="text-gray-300 text-sm">★</span>
                                                @endif
                                            @endfor
                                            <span class="ml-1 text-xs text-gray-600">({{ $wishlist->product->reviews()->count() }})</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 w-auto flex-none md:flex-1 md:w-5/12 hidden md:block">
                                    <div class="">
                                        <h6 class="font-semibold text-lg">IDR {{ number_format($wishlist->product->price) }}</h6>
                                    </div>
                                </div>
                                <div class="px-4 w-full md:w-2/12 flex justify-between md:justify-center items-center space-x-2 md:space-x-0 md:block">
                                    <form action="{{ route('wishlist.moveToCart', $wishlist->id) }}" method="POST">
                                        @csrf
                                        <button
                                            type="submit"
                                            class="bg-brown-400 text-white hover:bg-black px-4 py-2 rounded-full text-sm transition duration-200 flex items-center"
                                            {{ $wishlist->product->stock <= 0 ? 'disabled' : '' }}
                                        >
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                                            </svg>
                                            Add to Cart
                                        </button>
                                    </form>

                                    <form action="{{ route('wishlist.remove', $wishlist->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:underline px-4 py-2 rounded-full text-sm transition duration-200 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <p class="mt-4 text-lg text-gray-500">Your wishlist is empty</p>
                            <p class="text-gray-400">Browse our products and add your favorites to your wishlist.</p>
                            <a href="{{ route('products') }}" class="mt-6 inline-block bg-brown-400 text-white hover:bg-black px-6 py-3 rounded-full transition duration-200">
                                Browse Products
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- END: WISHLIST -->
@endsection
