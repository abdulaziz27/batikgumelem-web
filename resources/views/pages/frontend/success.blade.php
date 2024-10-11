@extends('layouts.frontend')

@section('content')
<!-- START: BREADCRUMB -->
<section class="bg-gray-100 py-8 px-4">
    <div class="container mx-auto">
        <ul class="breadcrumb">
            <li>
                <a href="{{ route('index') }}">Home</a>
            </li>
            <li>
                <a href="#" aria-label="current-page">Success Checkout</a>
            </li>
        </ul>
    </div>
</section>
<!-- END: BREADCRUMB -->

<!-- START: CONGRATS -->
<section class="">
    <div class="container mx-auto min-h-screen">
        <div class="flex flex-col items-center justify-center">
            <div class="w-full md:w-4/12 text-center">
                <img src="/frontend/images/content/illustration-success.png" alt="congrats illustration" />
                <h2 class="text-3xl font-semibold mb-6">
                    @if(request('order_id'))
                        Order Placed Successfully!
                    @else
                        Payment Successful!
                    @endif
                </h2>
                <p class="text-lg mb-12">
                    @if(request('order_id'))
                        Your order (ID: {{ request('order_id') }}) has been placed successfully.
                    @else
                        Your payment has been processed. We'll start preparing your order right away.
                    @endif
                    Barang yang anda beli akan kami kirimkan sekarang, so now please sit tight and be ready for it.
                </p>
                <a href="{{ route('dashboard.transaction.index') }}" class="text-white bg-brown-400 hover:bg-black focus:outline-none w-full py-3 rounded-full text-lg focus:text-black transition-all duration-200 px-8 cursor-pointer">
                    View Your Transactions
                </a>
            </div>
        </div>
    </div>
</section>
<!-- END: CONGRATS -->
@endsection
