@extends('layouts.frontend')

@section('content')
    <!-- START: BREADCRUMB -->
    <section class="bg-gray-100 py-8 px-4">
      <div class="container mx-auto">
        <ul class="breadcrumb flex items-center space-x-2 text-sm">
            <li><a href="{{ route('index') }}" class="text-grey-700 hover:text-brown-600">Beranda</a></li>
            <li><a href="{{ route('products') }}" class="text-grey-700 hover:text-brown-600">Produk</a></li>
            <li><span class="text-gray-500" aria-label="current-page">{{ $product->name }}</span></li>
        </ul>
      </div>
    </section>
    <!-- END: BREADCRUMB -->

    <!-- START: DETAILS -->
    <section class="container mx-auto">
    <div class="flex flex-wrap my-4 md:my-12">
        <div class="w-full md:hidden px-4">
            <h2 class="text-5xl font-semibold">{{ $product->name }}</h2>
            <span class="text-xl">IDR {{ number_format($product->price) }}</span>

            <!-- Product Rating -->
            <div class="flex items-center mt-2">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= round($product->average_rating))
                        <span class="text-yellow-400">★</span>
                    @else
                        <span class="text-gray-300">★</span>
                    @endif
                @endfor
                <span class="ml-1 text-sm text-gray-600">({{ $product->reviews()->count() }} reviews)</span>
            </div>

            <!-- Stock Indicator -->
            @if($product->stock > 0)
                <div class="mt-2 text-green-600">
                    In Stock ({{ $product->stock }} available)
                </div>
            @else
                <div class="mt-2 text-red-600">
                    Out of Stock
                </div>
            @endif
        </div>
        <div class="flex-1">
          <div class="slider">
            <div class="thumbnail overflow-x-auto whitespace-nowrap">
              <div class="px-2 flex sm:flex md:block lg:block">
                @foreach ($product->galleries as $item)
                  <div
                    class="item {{ $loop->first ? 'selected' : '' }} mb-2 md:mb-4 cursor-pointer"
                      data-img="{{ str_contains($item->url, 'storage') ? asset($item->url) : Storage::url($item->url) }}"
                    >
                    <img
                      src="{{ str_contains($item->url, 'storage') ? asset($item->url) : Storage::url($item->url) }}"
                      alt="gallery images"
                      class="object-cover w-full h-full rounded-lg "
                    />
                  </div>
                @endforeach
              </div>
            </div>
            <div class="preview">
              <div class="item rounded-lg h-full overflow-hidden">
                @php
                    $imageUrl = $product->galleries->first()->url ?? null;
                    $imageUrl = $imageUrl ? (str_contains($imageUrl, 'storage') ? asset($imageUrl) : asset('storage/' . $imageUrl)) : 'data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==';
                @endphp
                <img
                src="{{ $imageUrl }}"
                alt="selected image"
                class="object-cover w-full h-full rounded-lg"
                />
              </div>
            </div>
          </div>
        </div>
        <div class="flex-1 px-4 md:p-6">
          <h2 class="text-5xl font-semibold hidden md:block">{{ $product->name }}</h2>

          <!-- Product Rating (Desktop) -->
          <div class="flex items-center mt-2 hidden md:flex">
              @for($i = 1; $i <= 5; $i++)
                  @if($i <= round($product->average_rating))
                      <span class="text-yellow-400">★</span>
                  @else
                      <span class="text-gray-300">★</span>
                  @endif
              @endfor
              <span class="ml-1 text-sm text-gray-600">({{ $product->reviews()->count() }} reviews)</span>
          </div>

          <p class="text-xl hidden md:block mt-4">IDR {{ number_format($product->price) }}</p>

          <!-- Stock Indicator (Desktop) -->
          <div class="mt-2 hidden md:block">
              @if($product->stock > 0)
                  <div class="text-green-600">
                      In Stock ({{ $product->stock }} available)
                  </div>
              @else
                  <div class="text-red-600">
                      Out of Stock
                  </div>
              @endif
          </div>

          <form action="{{ route('cart-add', $product->id) }}" method="POST">
            @csrf
            <div class="flex items-center mb-4">
              </div>
                <button
                class="bg-brown-400 text-white hover:bg-black flex-none transition duration-200 rounded-full px-8 py-3 mt-4 inline-flex {{ $product->stock <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                {{ $product->stock <= 0 ? 'disabled' : '' }}
                ><svg
                    class="fill-current mr-3"
                    width="26"
                    height="24"
                    viewBox="0 0 26 24"
                >
                    <path
                    d="M10.8754 18.7312C9.61762 18.7312 8.59436 19.7115 8.59436 20.9164C8.59436 22.1214 9.61762 23.1017 10.8754 23.1017C12.1331 23.1017 13.1564 22.1214 13.1564 20.9164C13.1563 19.7115 12.1331 18.7312 10.8754 18.7312ZM10.8754 21.8814C10.3199 21.8814 9.86796 21.4485 9.86796 20.9163C9.86796 20.3842 10.3199 19.9512 10.8754 19.9512C11.4308 19.9512 11.8828 20.3842 11.8828 20.9163C11.8828 21.4486 11.4308 21.8814 10.8754 21.8814Z"
                    />
                    <path
                    d="M18.8764 18.7312C17.6186 18.7312 16.5953 19.7115 16.5953 20.9164C16.5953 22.1214 17.6186 23.1017 18.8764 23.1017C20.1342 23.1017 21.1575 22.1214 21.1575 20.9164C21.1574 19.7115 20.1341 18.7312 18.8764 18.7312ZM18.8764 21.8814C18.3209 21.8814 17.869 21.4485 17.869 20.9163C17.869 20.3842 18.3209 19.9512 18.8764 19.9512C19.4319 19.9512 19.8838 20.3842 19.8838 20.9163C19.8838 21.4486 19.4319 21.8814 18.8764 21.8814Z"
                    />
                    <path
                    d="M19.438 7.2262H10.3122C9.96051 7.2262 9.67542 7.49932 9.67542 7.83626C9.67542 8.1732 9.96056 8.44632 10.3122 8.44632H19.438C19.7897 8.44632 20.0748 8.1732 20.0748 7.83626C20.0748 7.49927 19.7897 7.2262 19.438 7.2262Z"
                    />
                    <path
                    d="M18.9414 10.3942H10.8089C10.4572 10.3942 10.1721 10.6673 10.1721 11.0042C10.1721 11.3412 10.4572 11.6143 10.8089 11.6143H18.9413C19.293 11.6143 19.5781 11.3412 19.5781 11.0042C19.5781 10.6673 19.293 10.3942 18.9414 10.3942Z"
                    />
                    <path
                    d="M25.6499 4.508C25.407 4.22245 25.0472 4.05871 24.6626 4.05871H4.82655L4.42595 2.19571C4.34232 1.80709 4.06563 1.48078 3.68565 1.32272L0.890528 0.160438C0.567841 0.0261566 0.192825 0.168008 0.0528584 0.477043C-0.0872597 0.786176 0.0608116 1.14549 0.383347 1.27957L3.17852 2.4419L6.2598 16.7708C6.38117 17.3351 6.90578 17.7446 7.50723 17.7446H22.7635C23.1152 17.7446 23.4003 17.4715 23.4003 17.1346C23.4003 16.7976 23.1152 16.5245 22.7635 16.5245H7.50728L7.13247 14.7815H22.8814C23.4828 14.7815 24.0075 14.3719 24.1288 13.8076L25.9101 5.52488C25.9876 5.16421 25.8928 4.79349 25.6499 4.508ZM22.8814 13.5615H6.87012L5.08895 5.27879L24.6626 5.27884L22.8814 13.5615Z"
                    />
                </svg>
                Tambah ke Keranjang
                </button>
          </form>

          <!-- Social Sharing -->
          <div class="mt-8">
            <h3 class="text-lg font-medium mb-3">Share this product:</h3>
            <div class="flex space-x-4">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('details', $product->slug)) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"/>
                    </svg>
                </a>
                <a href="https://twitter.com/intent/tweet?text={{ urlencode($product->name) }}&url={{ urlencode(route('details', $product->slug)) }}" target="_blank" class="text-blue-400 hover:text-blue-600">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                    </svg>
                </a>
                <a href="https://api.whatsapp.com/send?text={{ urlencode($product->name . ' - ' . route('details', $product->slug)) }}" target="_blank" class="text-green-600 hover:text-green-800">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                </a>
            </div>
          </div>

          <hr class="my-8" />

          <h6 class="text-xl font-semibold mb-4">Deskripsi Produk</h6>
          <div class="text-xl leading-7 mb-6">
            {!! $product->description !!}
          </div>

          <!-- Size Guide -->
          <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <h3 class="text-lg font-semibold mb-2">Size Guide</h3>
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-brown-100">
                        <th class="border border-gray-300 px-4 py-2">Size</th>
                        <th class="border border-gray-300 px-4 py-2">Length (cm)</th>
                        <th class="border border-gray-300 px-4 py-2">Width (cm)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">Small</td>
                        <td class="border border-gray-300 px-4 py-2">200</td>
                        <td class="border border-gray-300 px-4 py-2">110</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">Medium</td>
                        <td class="border border-gray-300 px-4 py-2">220</td>
                        <td class="border border-gray-300 px-4 py-2">115</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">Large</td>
                        <td class="border border-gray-300 px-4 py-2">240</td>
                        <td class="border border-gray-300 px-4 py-2">120</td>
                    </tr>
                </tbody>
            </table>
            <p class="text-sm mt-2 text-gray-600">*Measurements may vary slightly due to the handmade nature of our products.</p>
          </div>
        </div>
      </div>
    </section>
    <!-- END: DETAILS -->

    <!-- START: REVIEWS SECTION -->
    <section class="bg-gray-100 px-4 py-16">
        <div class="container mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-semibold">
                    Customer Reviews
                </h3>
                @auth
                    @if(!$product->hasBeenReviewedBy(Auth::id()))
                        <a href="{{ route('review.create', $product->id) }}" class="bg-brown-400 text-white hover:bg-black transition duration-200 rounded-full px-6 py-2">
                            Write a Review
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="bg-brown-400 text-white hover:bg-black transition duration-200 rounded-full px-6 py-2">
                        Login to Review
                    </a>
                @endauth
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Summary -->
                    <div class="md:w-1/3 border-b md:border-b-0 md:border-r border-gray-200 pb-6 md:pb-0 md:pr-6">
                        <div class="text-center">
                            <div class="text-5xl font-bold text-brown-400">{{ number_format($product->average_rating, 1) }}</div>
                            <div class="flex justify-center my-2">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= round($product->average_rating))
                                        <span class="text-yellow-400 text-xl">★</span>
                                    @else
                                        <span class="text-gray-300 text-xl">★</span>
                                    @endif
                                @endfor
                            </div>
                            <p class="text-gray-600">Based on {{ $product->reviews()->count() }} reviews</p>
                        </div>

                        <!-- Rating Breakdown -->
                        <div class="mt-6">
                            @for($i = 5; $i >= 1; $i--)
                                @php
                                    $count = $product->reviews()->where('rating', $i)->count();
                                    $percentage = $product->reviews()->count() > 0
                                        ? ($count / $product->reviews()->count()) * 100
                                        : 0;
                                @endphp
                                <div class="flex items-center mb-2">
                                    <div class="w-8">{{ $i }} ★</div>
                                    <div class="flex-1 mx-4 h-4 bg-gray-200 rounded">
                                        <div class="h-4 bg-yellow-400 rounded" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <div class="w-8 text-right">{{ $count }}</div>
                                </div>
                            @endfor
                        </div>
                    </div>

                    <!-- Reviews List -->
                    <div class="md:w-2/3">
                        @if($product->reviews()->where('is_approved', true)->count() > 0)
                            <div class="space-y-6">
                                @foreach($product->reviews()->where('is_approved', true)->latest()->get() as $review)
                                    <div class="border-b border-gray-200 pb-6 last:border-b-0 last:pb-0">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <div class="flex items-center">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $review->rating)
                                                            <span class="text-yellow-400">★</span>
                                                        @else
                                                            <span class="text-gray-300">★</span>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <h4 class="font-semibold mt-1">{{ $review->user->name }}</h4>
                                                <span class="text-sm text-gray-500">{{ $review->created_at->format('M d, Y') }}</span>
                                            </div>

                                            @if(Auth::check() && Auth::id() === $review->user_id)
                                                <div class="flex space-x-2">
                                                    <form action="{{ route('review.destroy', $review->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="mt-2">
                                            <p>{{ $review->comment }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <p class="text-gray-500">No reviews yet. Be the first to review this product!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END: REVIEWS SECTION -->

    <!-- START: PRODUCTS RECOMMENDATION -->
    <section class="bg-gray-100 px-4 py-16">
      <div class="container mx-auto">
        <div class="flex flex-start mb-4">
          <h3 class="text-2xl capitalize font-semibold">
            Produk lain <br class="" />yang juga kami rekomendasikan
          </h3>
        </div>
        <div class="flex overflow-x-auto mb-4 -mx-3">
          @foreach ($recommendations as $recommendation)
            <div class="px-3 flex-none" style="width: 320px">
              <div class="rounded-xl p-4 pb-8 relative bg-white h-[420px]">
                <div class="rounded-xl overflow-hidden card-shadow w-full h-[280px]">
                    @php
                        $imageUrl = $recommendation->galleries->isNotEmpty()
                            ? $recommendation->galleries->first()->url
                            : null;

                        $imageUrl = $imageUrl
                            ? (str_contains($imageUrl, 'storage') ? asset($imageUrl) : asset('storage/' . ltrim($imageUrl, '/')))
                            : 'data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==';
                    @endphp

                    <img
                        src="{{ $imageUrl }}"
                        alt="recommendation image"
                        class="w-full h-full object-cover object-center"
                    />
                </div>
                <h5 class="text-lg font-semibold mt-4">{{ $recommendation->name }}</h5>
                <span class="">IDR {{ number_format($recommendation->price) }}</span>
                <a href="{{ route('details', $recommendation->slug) }}" class="stretched-link">
                  <!-- fake children -->
                </a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
    <!-- END: PRODUCTS RECOMMENDATION -->
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const thumbnails = document.querySelectorAll('.thumbnail .item');
    const previewImage = document.querySelector('.preview img');

    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            const imgUrl = this.getAttribute('data-img');
            previewImage.src = imgUrl;

            // Remove 'selected' class from all thumbnails
            thumbnails.forEach(t => t.classList.remove('selected'));
            // Add 'selected' class to clicked thumbnail
            this.classList.add('selected');
        });
    });
});
</script>
@endsection
