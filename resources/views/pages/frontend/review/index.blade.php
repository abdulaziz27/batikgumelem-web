@extends('layouts.frontend')

@section('content')
    <!-- START: BREADCRUMB -->
    <section class="bg-gray-100 py-8 px-4">
        <div class="container mx-auto">
            <ul class="breadcrumb flex items-center space-x-2 text-sm">
                <li><a href="{{ route('index') }}" class="text-grey-700 hover:text-brown-600">Beranda</a></li>
                <li><a href="{{ route('products') }}" class="text-grey-700 hover:text-brown-600">Produk</a></li>
                <li><a href="{{ route('details', $product->slug) }}" class="text-grey-700 hover:text-brown-600">{{ $product->name }}</a></li>
                <li><span class="text-gray-500">Tulis Review</span></li>
            </ul>
        </div>
    </section>
    <!-- END: BREADCRUMB -->

    <!-- START: WRITE REVIEW -->
    <section class="bg-white py-16 px-4">
        <div class="container mx-auto max-w-3xl">
            <h1 class="text-3xl font-bold text-center mb-8">Review {{ $product->name }}</h1>

            <div class="flex flex-col md:flex-row gap-6 mb-8">
                <div class="md:w-1/3">
                    @php
                        $imageUrl = $product->galleries->first()->url ?? null;
                        $imageUrl = $imageUrl ? (str_contains($imageUrl, 'storage') ? asset($imageUrl) : asset('storage/' . $imageUrl)) : 'data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==';
                    @endphp
                    <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="w-full h-auto rounded-lg shadow">
                    <div class="mt-4 text-center">
                        <h3 class="font-semibold">{{ $product->name }}</h3>
                        <p class="text-brown-400 font-semibold">IDR {{ number_format($product->price) }}</p>
                    </div>
                </div>

                <div class="md:w-2/3">
                    <form action="{{ route('review.store', $product->id) }}" method="POST" class="bg-gray-50 rounded-lg p-6 shadow">
                        @csrf

                        @if($transactions->count() > 1)
                            <div class="mb-6">
                                <label for="transaction_id" class="block text-sm font-medium text-gray-700 mb-2">Which purchase are you reviewing?</label>
                                <select id="transaction_id" name="transaction_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brown-400 focus:ring focus:ring-brown-400">
                                    @foreach($transactions as $transaction)
                                        <option value="{{ $transaction->id }}">
                                            Order #{{ $transaction->id }} ({{ $transaction->created_at->format('M d, Y') }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <input type="hidden" name="transaction_id" value="{{ $transactions->first()->id }}">
                        @endif

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                            <div class="flex items-center space-x-1">
                                <input type="hidden" name="rating" id="rating_value" value="5">
                                @for($i = 1; $i <= 5; $i++)
                                    <button type="button" class="rating-star text-3xl text-yellow-400" data-value="{{ $i }}">★</button>
                                @endfor
                            </div>
                            @error('rating')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Your Review</label>
                            <textarea id="comment" name="comment" rows="5" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brown-400 focus:ring focus:ring-brown-400" placeholder="Share your experience with this product..."></textarea>
                            @error('comment')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-between">
                            <a href="{{ route('details', $product->slug) }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">Cancel</a>
                            <button type="submit" class="px-6 py-3 bg-brown-400 text-white rounded-md hover:bg-black transition">Submit Review</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- END: WRITE REVIEW -->
@endsection

@push('addon-script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('.rating-star');
        const ratingInput = document.getElementById('rating_value');

        // Set initial rating
        updateStars(5);

        stars.forEach(star => {
            star.addEventListener('click', function() {
                const value = parseInt(this.getAttribute('data-value'));
                ratingInput.value = value;
                updateStars(value);
            });
        });

        function updateStars(rating) {
            stars.forEach(star => {
                const starValue = parseInt(star.getAttribute('data-value'));
                if (starValue <= rating) {
                    star.classList.add('text-yellow-400');
                    star.classList.remove('text-gray-300');
                } else {
                    star.classList.add('text-gray-300');
                    star.classList.remove('text-yellow-400');
                }
            });
        }
    });
</script>
@endpush
