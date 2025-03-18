@extends('layouts.frontend')

@section('content')
    <!-- START: BREADCRUMB -->
    <section class="bg-gray-100 py-8 px-4">
        <div class="container mx-auto">
          <ul class="breadcrumb flex items-center space-x-2 text-sm">
              <li><a href="{{ route('index') }}" class="text-grey-700 hover:text-brown-600">Beranda</a></li>
              <li><span class="text-gray-500" aria-label="current-page">Cart</span></li>
          </ul>
        </div>
      </section>
    <!-- END: BREADCRUMB -->

    <!-- Display Messages -->
    @if(session('success'))
        <div class="container mx-auto px-4 py-2">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container mx-auto px-4 py-2">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- START: SHOPPING CART -->
    <section class="md:py-16">
      <div class="container mx-auto px-4">
        <div class="flex -mx-4 flex-wrap">
          <div class="w-full px-4 mb-4 md:w-8/12 md:mb-0" id="shopping-cart">
            <div
              class="flex flex-start mb-4 mt-8 pb-3 border-b border-gray-200 md:border-b-0"
            >
              <h3 class="text-2xl">Shopping Cart</h3>
            </div>

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

            <!-- START: ROW 1 -->
            @forelse ($carts as $item)
               <div
                  class="flex flex-start flex-wrap items-center mb-4 -mx-4 {{ isset($item->stock_warning) ? 'bg-yellow-50 rounded-lg' : '' }}"
                  data-row="1"
                >
                  <div class="px-4 flex-none">
                    <div class="" style="width: 90px; height: 90px">
                        @php
                        // Cek apakah gallery ada dan tidak kosong
                        $imageUrl = $item->product->galleries->isNotEmpty()
                            ? $item->product->galleries->first()->url
                            : null;

                        // Tentukan URL gambar dengan default jika null
                        $imageUrl = $imageUrl
                            ? (str_contains($imageUrl, 'storage') ? asset($imageUrl) : asset('storage/' . ltrim($imageUrl, '/')))
                            : 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mN88B8AAsUB4ZtvXtIAAAAASUVORK5CYII=';
                        @endphp
                      <img
                        src="{{ $imageUrl }}"
                        alt="Product Image"
                        class="object-cover rounded-xl w-full h-full {{ $item->product->stock <= 0 ? 'opacity-50' : '' }}"
                      />
                    </div>
                  </div>
                  <div class="px-4 w-auto flex-1 md:w-5/12">
                    <div class="">
                      <h6 class="font-semibold text-lg md:text-xl leading-8">
                        {{ $item->product->name }}
                      </h6>
                      <span class="text-sm md:text-lg">{{ $item->quantity }} pcs</span>
                      <h6
                        class="font-semibold text-base md:text-lg block md:hidden"
                      >
                        IDR {{ number_format($item->product->price) }}
                      </h6>

                      <!-- Stock Warning -->
                      @if(isset($item->stock_warning))
                        <div class="text-yellow-600 text-sm mt-1">
                            <svg class="inline-block w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            {{ $item->stock_warning }}
                        </div>
                      @endif

                      <!-- Stock Status -->
                      @if($item->product->stock <= 0)
                        <div class="text-red-600 text-sm mt-1">Out of Stock</div>
                      @elseif($item->product->stock < 5)
                        <div class="text-yellow-600 text-sm mt-1">Only {{ $item->product->stock }} left</div>
                      @endif
                    </div>
                  </div>
                  <div
                    class="px-4 w-auto flex-none md:flex-1 md:w-5/12 hidden md:block"
                  >
                    <div class="">
                      <h6 class="font-semibold text-lg">IDR {{ number_format($item->product->price * $item->quantity) }}</h6>
                    </div>
                  </div>
                  <div class="px-4 w-2/12">
                    <div class="text-center">
                      <form action="{{ route('cart-delete', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 border-none focus:outline-none px-3 py-1">
                          X
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
            @empty
              <p id="cart-empty" class="text-center py-8">
                Ooops... Keranjangmu Masih Kosong
                <a href="{{ route('index') }}" class="underline">Belanja Sekarang!</a>
              </p>
            @endforelse
            <!-- END: ROW 1 -->

            <!-- START: Voucher Code -->
            <div class="flex flex-col mt-8">
              <h3 class="text-xl mb-4">Apply Voucher Code</h3>
              <form action="#" method="POST" class="flex">
                <input
                  type="text"
                  name="voucher_code"
                  id="voucher_code"
                  class="border-gray-200 border rounded-l-lg px-4 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none flex-grow"
                  placeholder="Enter voucher code"
                />
                <button
                  type="submit"
                  class="bg-brown-400 text-white hover:bg-black focus:outline-none rounded-r-lg px-4 py-2 transition-all duration-200"
                >
                  Apply
                </button>
              </form>
            </div>
            <!-- END: Voucher Code -->

            <!-- START: Order Summary -->
            <div class="mt-8">
              <h3 class="text-xl mb-4">Order Summary</h3>
              <div class="bg-gray-100 px-4 py-6 rounded-lg">
                <div class="flex justify-between mb-2">
                  <span>Subtotal</span>
                  <span class="font-semibold">IDR {{ number_format($carts->sum(function($item) { return $item->product->price * $item->quantity; })) }}</span>
                </div>
                <div class="flex justify-between mb-2">
                  <span>Shipping Fee</span>
                  <span class="font-semibold">IDR {{ number_format(20000) }}</span>
                </div>
                <div class="flex justify-between mb-2">
                  <span>Discount</span>
                  <span class="font-semibold text-green-500">- IDR 20,000</span>
                </div>
                <div class="border-t border-gray-200 mt-4 pt-4 flex justify-between">
                  <span class="font-semibold">Total</span>
                  <span class="font-semibold">IDR {{ number_format($carts->sum(function($item) { return $item->product->price * $item->quantity; })) }}</span>
                </div>
              </div>
            </div>
            <!-- END: Order Summary -->
          </div>
          <div class="w-full md:px-4 md:w-4/12" id="shipping-detail">
            <div class="bg-gray-100 px-4 py-6 md:p-8 md:rounded-3xl">
              <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <div class="flex flex-start mb-6">
                  <h3 class="text-2xl">Shipping Details</h3>
                </div>

                <div class="flex flex-col mb-4">
                  <label for="complete-name" class="text-sm mb-2"
                    >Complete Name</label
                  >
                  <input
                    data-input
                    name="name"
                    type="text"
                    id="complete-name"
                    class="border-gray-200 border rounded-lg px-4 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none"
                    placeholder="Masukan nama lengkap penerima"
                  />
                </div>

                <div class="flex flex-col mb-4">
                  <label for="email" class="text-sm mb-2">Email Address</label>
                  <input
                    data-input
                    name="email"
                    type="email"
                    id="email"
                    class="border-gray-200 border rounded-lg px-4 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none"
                    placeholder="Masukan email"
                  />
                </div>

                <div class="flex flex-col mb-4">
                  <label for="address" class="text-sm mb-2">Address</label>
                  <input
                    data-input
                    type="text"
                    name="address"
                    id="address"
                    class="border-gray-200 border rounded-lg px-4 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none"
                    placeholder="Masukan alamat lengkap"
                  />
                </div>

                <div class="flex flex-col mb-4">
                  <label for="phone-number" class="text-sm mb-2"
                    >Phone Number</label
                  >
                  <input
                    data-input
                    type="tel"
                    name="phone"
                    id="phone-number"
                    class="border-gray-200 border rounded-lg px-4 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none"
                    placeholder="Masukan nomor telpon"
                  />
                </div>

                <div class="flex flex-col mb-4">
                    <label for="complete-name" class="text-sm mb-2">Choose Payment</label>
                    <div class="flex -mx-2 flex-wrap">
                        <div class="px-2 w-6/12 h-24 mb-4">
                            <label class="border border-gray-200 flex items-center justify-center rounded-xl bg-white w-full h-full cursor-pointer payment-option">
                                <input type="radio" name="payment" value="midtrans" class="hidden" required>
                                <img src="/frontend/images/content/logo-midtrans.png" alt="Logo midtrans" class="object-contain max-h-full">
                            </label>
                        </div>
                        <div class="px-2 w-6/12 h-24 mb-4">
                            <label class="border border-gray-200 flex items-center justify-center rounded-xl bg-white w-full h-full cursor-pointer payment-option">
                                <input type="radio" name="payment" value="gopay" class="hidden" required>
                                <img src="/frontend/images/content/logo-gopay.png" alt="Logo Gopay">
                            </label>
                        </div>
                    </div>
                </div>
                @error('payment')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <!-- Check if any item is out of stock -->
                @php
                    $anyOutOfStock = $carts->contains(function($item) {
                        return $item->product->stock <= 0;
                    });
                @endphp

                <div class="text-center">
                    <button
                        type="submit"
                        class="bg-brown-400 text-white hover:bg-black focus:outline-none w-full py-3 rounded-full text-lg transition-all duration-200 px-6 {{ $anyOutOfStock || $carts->isEmpty() ? 'opacity-50 cursor-not-allowed' : '' }}"
                        {{ $anyOutOfStock || $carts->isEmpty() ? 'disabled' : '' }}
                    >
                        Checkout Now
                    </button>

                    @if($anyOutOfStock)
                        <p class="text-red-500 text-sm mt-2">
                            Please remove out of stock items from your cart before proceeding.
                        </p>
                    @endif
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END: COMPLETE SHOPPING CART  -->
@endsection

@push('addon-script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM fully loaded and parsed');

    const paymentOptions = document.querySelectorAll('.payment-option');

    function handleSelection(options) {
        options.forEach(option => {
            option.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('Option clicked:', this);
                // Remove border from all options in this group
                options.forEach(opt => {
                    opt.classList.remove('border-red-200');
                    opt.classList.add('border-gray-200');
                });
                // Add border to selected option
                this.classList.remove('border-gray-200');
                this.classList.add('border-red-200');
                // Check the radio input
                const radioInput = this.querySelector('input[type="radio"]');
                radioInput.checked = true;
            });
        });
    }

    handleSelection(paymentOptions);

    console.log('Event listeners added to', paymentOptions.length, 'payment options');
});
</script>
@endpush
