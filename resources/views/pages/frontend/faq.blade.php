@extends('layouts.frontend')

@section('content')
    <!-- START: BREADCRUMB -->
    <section class="bg-gray-100 py-8 px-4">
        <div class="container mx-auto">
            <ul class="breadcrumb flex items-center space-x-2 text-sm">
                <li><a href="{{ route('index') }}" class="text-grey-700 hover:text-brown-600">Beranda</a></li>
                <li><span class="text-gray-500">FAQ</span></li>
            </ul>
        </div>
    </section>
    <!-- END: BREADCRUMB -->

    <!-- START: FAQ CONTENT -->
    <section class="bg-white py-16 px-4">
        <div class="container mx-auto">
            <div class="text-center mb-24">
                <h1 class="text-3xl font-semibold text-gray-900 sm:text-4xl">Frequently Asked Questions</h1>
                <p class="mt-4 text-lg text-gray-600">Temukan pertanyaan yang sering ditanyakan oleh pelanggan.</p>
            </div>

            @php
                $faqs = [
                    [
                        'question' => 'Bagaimana cara melacak pesanan saya?',
                        'answer' => 'Masuk ke akun Anda, buka dashboard user, dan klik "Riwayat Pesanan" untuk melihat status terkini pesanan Anda.',
                    ],
                    [
                        'question' => 'Apakah ada garansi untuk produk batik?',
                        'answer' => 'Kami menjamin kualitas setiap produk. Jika ada masalah, hubungi layanan pelanggan kami dalam 7 hari setelah menerima produk.',
                    ],
                    [
                        'question' => 'Bagaimana cara merawat batik?',
                        'answer' => 'Cuci dengan lembut menggunakan air dingin, jangan diperas, dan jemur di tempat teduh. Lihat label perawatan pada setiap produk untuk petunjuk spesifik.',
                    ],
                    [
                        'question' => 'Bagaimana cara menjadi admin?',
                        'answer' => 'Status admin hanya diberikan oleh pemilik website. Jika Anda adalah karyawan yang berwenang, hubungi manajer IT Anda untuk mendapatkan akses admin.',
                    ],
                ];
            @endphp

            <div x-data="{
                activeAccordion: null,
                setActiveAccordion(id) {
                    this.activeAccordion = this.activeAccordion === id ? null : id
                }
            }" class="space-y-4">
                @foreach ($faqs as $index => $faq)
                    <div
                        class="bg-white rounded-lg border overflow-hidden hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1">
                        <button @click="setActiveAccordion({{ $index }})" class="w-full p-6 text-left">
                            <h3 class="text-lg font-semibold flex items-center justify-between">
                                <span>{{ $faq['question'] }}</span>
                                <svg class="w-6 h-6 text-gray-400 transform transition-transform duration-300"
                                    :class="{ 'rotate-180': activeAccordion === {{ $index }} }"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </h3>
                        </button>
                        <div x-ref="container{{ $index }}"
                            x-bind:style="activeAccordion === {{ $index }} ?
                                'max-height: ' + $refs.container{{ $index }}.scrollHeight + 'px' :
                                'max-height: 0px'"
                            class="overflow-hidden transition-all duration-300 ease-in-out">
                            <div class="px-6 pb-6 text-gray-600">
                                {!! $faq['answer'] !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- END: FAQ CONTENT -->
@endsection

@push('addon-script')
<script>
    // Add if any additional JavaScript here
</script>
@endpush
