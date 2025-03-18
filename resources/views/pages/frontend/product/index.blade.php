@extends('layouts.frontend')

@section('content')
<!-- START: BREADCRUMB -->
<section class="bg-gray-100 py-8 px-4">
    <div class="container mx-auto">
        <!-- Simple Search Bar with Filter Toggle -->
        <div class="bg-white rounded-lg shadow-sm p-4 mb-4">
            <form action="{{ route('products') }}" method="GET" id="searchForm">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif

                <div class="flex flex-col md:flex-row gap-2">
                    <!-- Search input -->
                    <div class="flex-grow">
                        <div class="relative">
                            <input type="text" name="search" id="search" placeholder="Search products..."
                                class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-400"
                                value="{{ request('search') }}">
                            <button type="submit" class="absolute inset-y-0 right-0 px-3 flex items-center">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Filter Toggle Button -->
                    <button type="button" id="filterToggle" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-300 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        Filters
                        @if(request('min_price') || request('max_price') || request('min_rating') || request('in_stock') || request('sort'))
                            <span class="ml-2 inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-brown-400 rounded-full">✓</span>
                        @endif
                    </button>
                </div>

                <!-- Advanced Filters (Hidden by default) -->
                <div id="advancedFilters" class="mt-4 border-t pt-4 hidden">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                        <select name="sort" id="sort" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-brown-400">
                            <option value="new" {{ request('sort') == 'new' ? 'selected' : '' }}>Newest</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <div class="flex items-center">
                            <input type="checkbox" name="in_stock" id="in_stock" value="1" class="h-4 w-4 text-brown-400 focus:ring-brown-400 border-gray-300 rounded" {{ request('in_stock') == '1' ? 'checked' : '' }}>
                            <label for="in_stock" class="ml-2 block text-sm text-gray-700">In Stock Only</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Price Range</label>
                        <div class="flex space-x-2">
                            <div class="w-1/2">
                                <input type="text" name="min_price" placeholder="Min"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-brown-400"
                                    value="{{ request('min_price') }}">
                            </div>
                            <div class="w-1/2">
                                <input type="text" name="max_price" placeholder="Max"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-brown-400"
                                    value="{{ request('max_price') }}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="min_rating" class="block text-sm font-medium text-gray-700 mb-2">Minimum Rating</label>
                        <select name="min_rating" id="min_rating" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-brown-400">
                            <option value="">Any Rating</option>
                            <option value="5" {{ request('min_rating') == '5' ? 'selected' : '' }}>5 Stars</option>
                            <option value="4" {{ request('min_rating') == '4' ? 'selected' : '' }}>4+ Stars</option>
                            <option value="3" {{ request('min_rating') == '3' ? 'selected' : '' }}>3+ Stars</option>
                            <option value="2" {{ request('min_rating') == '2' ? 'selected' : '' }}>2+ Stars</option>
                            <option value="1" {{ request('min_rating') == '1' ? 'selected' : '' }}>1+ Stars</option>
                        </select>
                    </div>

                    <!-- Filter Action Buttons -->
                    <div class="flex justify-end space-x-2 mt-4">
                        <a href="{{ route('products', request('category') ? ['category' => request('category')] : []) }}"
                           class="px-6 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition duration-300 text-sm">
                            Reset
                        </a>
                        <button type="submit"
                                class="px-6 py-2 bg-brown-400 text-white rounded-md hover:bg-brown-500 transition duration-300 text-sm">
                            Apply Filters
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- END: BREADCRUMB -->

<!-- START: Products Grid -->
<section class="bg-white px-4 py-8">
    <div class="container mx-auto">
      <div class="flex flex-wrap -mx-4">
        @forelse ($products as $product)
          <div class="px-4 mb-8 relative" style="width: 320px">
            <div class="card group">
              <div
                class="rounded-xl overflow-hidden card-shadow relative"
                style="width: 287px; height: 386px"
              >
                <div
                  class="absolute opacity-0 group-hover:opacity-100 transition duration-200 flex items-center justify-center w-full h-full bg-black bg-opacity-35 z-10"
                >
                  <div class="flex space-x-2">
                    <!-- View Details Icon -->
                    <a href="{{ route('details', $product->slug) }}" class="bg-white text-black rounded-full w-12 h-12 flex items-center justify-center hover:bg-gray-100 transition duration-200 z-20">
                      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                      </svg>
                    </a>

                    <!-- Wishlist Button -->
                    @auth
                    <form class="wishlist-form" action="{{ route('wishlist.toggle', $product->id) }}" method="POST">
                        @csrf
                        <button type="button"
                                onclick="submitWishlistForm(this)"
                                class="wishlist-button bg-white rounded-full w-12 h-12 flex items-center justify-center hover:bg-gray-100 transition duration-200 z-20 {{ Auth::user()->hasInWishlist($product->id) ? 'text-red-600' : 'text-black' }}">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="bg-white text-black hover:text-red-600 rounded-full w-12 h-12 flex items-center justify-center hover:bg-gray-100 transition duration-200 z-20">
                      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
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
                        ? (str_contains($imageUrl, 'storage') ? asset($imageUrl) : asset('storage/' . ltrim($imageUrl, '/')))
                        : 'data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==';
                @endphp
                <img
                    src="{{ $imageUrl }}"
                    alt="{{ $product->name }}"
                    class="w-full h-full object-cover object-center"
                />
              </div>
              <div class="mt-4">
                <h5 class="text-lg font-semibold">{{ $product->name }}</h5>
                <div class="flex justify-between items-center mt-2">
                  <span>IDR {{ number_format($product->price) }}</span>

                  <!-- Stock & Rating -->
                  <div class="flex items-center">
                      @if($product->stock > 0)
                          <span class="text-xs text-green-600 mr-2">In Stock</span>
                      @else
                          <span class="text-xs text-red-600 mr-2">Out of Stock</span>
                      @endif

                      <div class="flex items-center">
                          <span class="text-yellow-400 text-sm">★</span>
                          <span class="text-xs text-gray-600 ml-1">{{ number_format($product->average_rating, 1) }}</span>
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
        @empty
          <div class="w-full text-center py-16">
            <p class="text-gray-500 text-xl">No products found.</p>
          </div>
        @endforelse
      </div>
    </div>
  </section>
  <!-- END: Products Grid -->

  <!-- Pagination -->
  <div class="container mx-auto px-4 py-8">
      {{ $products->appends(request()->all())->links() }}
  </div>
@endsection

@push('addon-script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter toggle functionality
        const filterToggle = document.getElementById('filterToggle');
        const advancedFilters = document.getElementById('advancedFilters');

        // Check if any filters are applied to show the filter section by default
        const hasActiveFilters = {{ request('min_price') || request('max_price') || request('min_rating') || request('in_stock') || request('sort') ? 'true' : 'false' }};

        if (hasActiveFilters) {
            advancedFilters.classList.remove('hidden');
        }

        filterToggle.addEventListener('click', function() {
            advancedFilters.classList.toggle('hidden');
        });

        // Ensure overlay buttons correctly stop event propagation
        document.querySelectorAll('.card .z-20').forEach(element => {
            element.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });
    });

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
</script>
@endpush
