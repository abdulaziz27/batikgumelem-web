<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Tracking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('dashboard.tracking.index') }}" method="GET" class="mb-6">
                        <div class="flex items-center">
                            <input type="text" name="transaction_id" placeholder="Enter Transaction ID" class="flex-1 px-4 py-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <button type="submit" class="px-4 py-2 bg-brown-400 text-white rounded-r-md hover:bg-black focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Track Transaction
                            </button>
                        </div>
                    </form>

                    <h3 class="text-lg font-semibold mb-4">Recent Transactions</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($recentTransactions as $transaction)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->status }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('dashboard.tracking.show', $transaction->id) }}" class="text-indigo-600 hover:text-indigo-900">Track</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-16"></div>
</x-app-layout>
