@extends('layouts.frontend')

@section('content')
    <!-- START: BREADCRUMB -->
    <section class="bg-gray-100 py-8 px-4">
        <div class="container mx-auto">
            <ul class="breadcrumb flex items-center space-x-2 text-sm">
                <li><a href="{{ route('index') }}" class="text-grey-700 hover:text-brown-600">Beranda</a></li>
                <li><span class="text-gray-500">Blogs</span></li>
            </ul>
        </div>
    </section>
    <!-- END: BREADCRUMB -->

    <!-- START: BLOG HEADER -->
    <section class="bg-brown-100 py-12 px-4">
        <div class="text-center mb-3">
            <h3 class="text-3xl capitalize font-semibold">
                Blog <br class="sm:hidden" /> Posts
            </h3>
            <p class="text-gray-400 text-lg mt-2 max-w-2xl mx-auto">
                Jelajahi kisah-kisah menarik, tips kreatif, dan wawasan mendalam seputar dunia batik Gumelem dan warisan budaya Indonesia.
            </p>
        </div>
    </section>
    <!-- END: BLOG HEADER -->

    <!-- START: BLOG POSTS -->
    <div class="container mx-auto px-4 py-8 flex-grow flex flex-col min-h-[70vh]">
        @if($blogs->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($blogs as $blog)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col w-full transition duration-300 ease-in-out transform hover:shadow-md hover:scale-105 hover:border-brown-400 hover:border-2">
                        @if($blog->featured_image)
                            <div class="aspect-w-16 aspect-h-9">
                                <img src="{{ asset('storage/' . $blog->featured_image) }}"
                                     alt="{{ $blog->title }}"
                                     class="w-full h-full object-cover">
                            </div>
                        @endif
                        <div class="p-4 flex-grow flex flex-col">
                            <h2 class="text-lg font-semibold mb-2 line-clamp-2">{{ $blog->title }}</h2>
                            <p class="text-sm text-gray-600 mb-4 line-clamp-3">{{ Str::limit(strip_tags($blog->content), 80) }}</p>
                            <div class="mt-auto flex items-center justify-between text-xs">
                                <span class="text-gray-500">By {{ $blog->user->name }}</span>
                                <a href="{{ route('blogs.show', $blog->slug) }}" class="text-blue-500 hover:underline">Read more</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $blogs->links() }}
            </div>
        @else
            <div class="flex-grow flex items-center justify-center">
                <div class="text-center">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Belum ada blog yang tersedia</h2>
                    <p class="text-gray-500">Silakan kembali lagi nanti untuk melihat konten terbaru kami.</p>
                </div>
            </div>
        @endif
    </div>
    <!-- END: BLOG POSTS -->
@endsection

@push('styles')
<style>
    .aspect-w-16 {
        position: relative;
        padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
    }
    .aspect-w-16 > img {
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        object-fit: cover;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush
