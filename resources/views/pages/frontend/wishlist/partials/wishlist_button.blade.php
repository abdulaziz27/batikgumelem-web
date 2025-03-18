@auth
    @php
        $inWishlist = Auth::user()->hasInWishlist($product->id);
    @endphp
    <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST" class="inline-block">
        @csrf
        <button type="submit" class="inline-flex items-center px-4 py-2 ml-3 border border-gray-300 rounded-full hover:bg-gray-100 transition duration-200 wishlist-button {{ $inWishlist ? 'text-red-600' : 'text-gray-600' }}">
            <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
            </svg>
            {{ $inWishlist ? 'Saved' : 'Add to Wishlist' }}
        </button>
    </form>
@else
    <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 ml-3 border border-gray-300 rounded-full hover:bg-gray-100 transition duration-200 text-gray-600">
        <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
        </svg>
        Add to Wishlist
    </a>
@endauth
