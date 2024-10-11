<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction Tracking Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Transaction #{{ $transaction->id }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <p><strong>Transaction Date:</strong> {{ $transaction->created_at->format('Y-m-d H:i') }}</p>
                            <p><strong>Status:</strong> {{ $transaction->status }}</p>
                            <p><strong>Total Amount:</strong> IDR {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p><strong>Shipping Address:</strong> {{ $transaction->address }}</p>
                            <p><strong>Resi Number: </strong> 000826314800</p>
                            <p><strong>Courier:</strong> Alenna </p>
                        </div>
                    </div>

                    <h4 class="text-md font-semibold mb-2">Items</h4>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($transaction->transactionItems as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->product->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->quantity }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">IDR {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">IDR {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <h4 class="text-md font-semibold mt-6 mb-2">Tracking Status</h4>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-2 h-2 rounded-full bg-blue-500 mr-4"></div>
                            <div>
                                <p class="font-semibold">{{ $transaction->status }}</p>
                                <p class="text-sm text-gray-500">{{ $transaction->updated_at->format('Y-m-d H:i') }}</p>
                                <p>{{ $transaction->status_description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
