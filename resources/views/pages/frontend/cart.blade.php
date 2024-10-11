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
                  class="flex flex-start flex-wrap items-center mb-4 -mx-4"
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
                        class="object-cover rounded-xl w-full h-full"
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

                {{-- <div class="flex flex-col mb-4">
                    <label for="complete-name" class="text-sm mb-2">Choose Courier</label>
                    <div class="flex -mx-2 flex-wrap">
                        <div class="px-2 w-6/12 h-24 mb-4">
                            <label class="border border-gray-200 flex items-center justify-center rounded-xl bg-white w-full h-full cursor-pointer courier-option">
                                <input type="radio" name="courier" value="jnt" class="hidden" required>
                                <img src="/frontend/images/content/logo-jnt.svg" alt="Logo JNT" class="object-contain max-h-full">
                            </label>
                        </div>
                        <div class="px-2 w-6/12 h-24 mb-4">
                            <label class="border border-gray-200 flex items-center justify-center rounded-xl bg-white w-full h-full cursor-pointer courier-option">
                                <input type="radio" name="courier" value="sicepat" class="hidden" required>
                                <img src="/frontend/images/content/sicepat.png" alt="Logo Sicepat" class="object-contain max-h-full">
                            </label>
                        </div>
                    </div>
                </div> --}}

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
                <div class="text-center">
                    <button
                        type="submit"
                        class="bg-brown-400 text-white hover:bg-black focus:outline-none w-full py-3 rounded-full text-lg transition-all duration-200 px-6"
                    >
                        Checkout Now
                    </button>
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

    const courierOptions = document.querySelectorAll('.courier-option');
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

    handleSelection(courierOptions);
    handleSelection(paymentOptions);

    console.log('Event listeners added to', courierOptions.length, 'courier options and', paymentOptions.length, 'payment options');
});
</script>
@endpush
