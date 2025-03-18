@extends('layouts.frontend')

@section('content')
<!-- START: BREADCRUMB -->
<section class="bg-gray-100 py-8 px-4">
    <div class="container mx-auto">
        <ul class="breadcrumb flex items-center space-x-2 text-sm">
            <li><a href="{{ route('index') }}" class="text-grey-700 hover:text-brown-600">{{ __('messages.home') }}</a></li>
            <li><span class="text-gray-500">Language Test</span></li>
        </ul>
    </div>
</section>
<!-- END: BREADCRUMB -->

<!-- START: LANGUAGE TEST -->
<section class="bg-white py-16 px-4">
    <div class="container mx-auto max-w-4xl">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-semibold">{{ __('messages.language') }} Test</h1>
            <p class="text-gray-500 mt-2">{{ __('Current language') }}: {{ App::getLocale() === 'en' ? 'English' : 'Bahasa Indonesia' }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
            <div class="bg-gray-50 p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Navigation Terms</h2>
                <ul class="space-y-2">
                    <li><strong>Home:</strong> {{ __('messages.home') }}</li>
                    <li><strong>Products:</strong> {{ __('messages.products') }}</li>
                    <li><strong>History:</strong> {{ __('messages.history') }}</li>
                    <li><strong>Blog:</strong> {{ __('messages.blog') }}</li>
                    <li><strong>Dashboard:</strong> {{ __('messages.dashboard') }}</li>
                    <li><strong>Login:</strong> {{ __('messages.login') }}</li>
                    <li><strong>Register:</strong> {{ __('messages.register') }}</li>
                </ul>
            </div>

            <div class="bg-gray-50 p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Product Page Terms</h2>
                <ul class="space-y-2">
                    <li><strong>Add to Cart:</strong> {{ __('messages.add_to_cart') }}</li>
                    <li><strong>Add to Wishlist:</strong> {{ __('messages.add_to_wishlist') }}</li>
                    <li><strong>Product Description:</strong> {{ __('messages.product_description') }}</li>
                    <li><strong>Size Guide:</strong> {{ __('messages.size_guide') }}</li>
                    <li><strong>Customer Reviews:</strong> {{ __('messages.customer_reviews') }}</li>
                    <li><strong>In Stock:</strong> {{ __('messages.in_stock') }}</li>
                    <li><strong>Out of Stock:</strong> {{ __('messages.out_of_stock') }}</li>
                </ul>
            </div>
        </div>

        <div class="text-center">
            <h2 class="text-xl font-semibold mb-4">Try Switching Language</h2>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('language.switch', 'en') }}" class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium {{ App::getLocale() === 'en' ? 'bg-brown-400 text-white border-brown-400' : 'text-gray-700' }}">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="#f0f0f0" d="M0 85.33h512v341.337H0z"/>
                        <path fill="#d80027" d="M0 85.33h512v113.775H0z"/>
                        <path fill="#0052b4" d="M0 312.884h512v113.775H0z"/>
                    </svg>
                    {{ __('messages.english') }}
                </a>
                <a href="{{ route('language.switch', 'id') }}" class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium {{ App::getLocale() === 'id' ? 'bg-brown-400 text-white border-brown-400' : 'text-gray-700' }}">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="#f0f0f0" d="M0 85.337h512v341.326H0z"/>
                        <path fill="#a2001d" d="M0 85.337h512v170.663H0z"/>
                    </svg>
                    {{ __('messages.indonesian') }}
                </a>
            </div>
        </div>
    </div>
</section>
<!-- END: LANGUAGE TEST -->
@endsection
