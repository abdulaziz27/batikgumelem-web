@extends('layouts.frontend')

@section('content')

<!-- START: BREADCRUMB -->
<section class="bg-gray-100 py-8 px-4">
    <div class="container mx-auto">
        <ul class="breadcrumb flex items-center space-x-2 text-sm">
            <li><a href="{{ route('index') }}" class="text-grey-700 hover:text-brown-600">Beranda</a></li>
            <li><a href="{{ route('blogs.index') }}" class="text-grey-700 hover:text-brown-600">Blog</a></li>
            @if($blog->featured_image)
            <li><span class="text-gray-500">{{ $blog->title }}</span></li>
        </ul>
    </div>
</section>
<!-- END: BREADCRUMB -->

<div class="bg-gray-100 min-h-screen py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
        <article class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="relative h-64 sm:h-80 md:h-96">
                    <img src="{{ asset('storage/' . $blog->featured_image) }}"
                         alt="{{ $blog->title }}"
                         class="w-full h-full object-cover">
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6">
                        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white">
                            {{ $blog->title }}
                        </h1>
                    </div>
                </div>
            @else
                <div class="bg-gray-200 p-6">
                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800">
                        {{ $blog->title }}
                    </h1>
                </div>
            @endif

            <div class="p-6">
                <div class="flex items-center mb-6 text-sm">
                    <div class="flex items-center mr-6">
                        @if($blog->user->avatar)
                            <img src="{{ asset('storage/' . $blog->user->avatar) }}"
                                 alt="{{ $blog->user->name }}"
                                 class="w-10 h-10 rounded-full mr-3 object-cover">
                        @else
                            <div class="w-10 h-10 rounded-full bg-gray-300 mr-3 flex items-center justify-center">
                                <span class="text-gray-600 font-semibold">{{ substr($blog->user->name, 0, 1) }}</span>
                            </div>
                        @endif
                        <span class="text-gray-700 font-medium">{{ $blog->user->name }}</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-gray-500">{{ $blog->published_at->format('F j, Y') }}</span>
                    </div>
                </div>

                <div class="prose prose-lg max-w-none">
                    {!! $blog->content !!}
                </div>

                <div class="mt-8 pt-8 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Share this article:</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-blue-600 hover:text-blue-800">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-blue-400 hover:text-blue-600">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-blue-500 hover:text-blue-700">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </article>
    </div>
</div>
@endsection

@push('styles')
<style>
    .prose img {
        @apply rounded-lg shadow-md my-8 mx-auto;
    }
    .prose a {
        @apply text-blue-600 hover:text-blue-800 underline;
    }
    .prose h2 {
        @apply text-2xl font-bold mt-8 mb-4;
    }
    .prose h3 {
        @apply text-xl font-semibold mt-6 mb-3;
    }
    .prose ul, .prose ol {
        @apply my-4 pl-6;
    }
    .prose li {
        @apply mb-2;
    }
    .prose blockquote {
        @apply border-l-4 border-gray-300 pl-4 italic my-6 text-gray-700;
    }
    .prose pre {
        @apply bg-gray-100 rounded-md p-4 overflow-x-auto;
    }
    .prose code {
        @apply bg-gray-100 rounded px-1 py-0.5 text-sm;
    }
</style>
@endpush
