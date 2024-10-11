<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('dashboard.transaction.index') }}" class="block p-6 bg-blue-100 rounded-lg hover:bg-blue-200 transition">
                            <h3 class="text-lg font-semibold mb-2">Transactions</h3>
                            <p>Lihat daftar transaksi anda</p>
                        </a>
                        <a href="{{ route('dashboard.tracking.index') }}" class="block p-6 bg-yellow-100 rounded-lg hover:bg-yellow-200 transition">
                            <h3 class="text-lg font-semibold mb-2">Tracking</h3>
                            <p>Lacak orderan anda</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-16"></div>
    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    {{ __("You're logged in! But Not Verified") }}
                </div>
            </div>
        </div>
    </div> --}}
</x-app-layout>

