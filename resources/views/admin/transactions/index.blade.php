<x-admin-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h11M9 21h6m2-11l-1.41-1.41a2 2 0 00-2.83 0L7 15m-4 0a4 4 0 104 4h.5a2.5 2.5 0 000-5H3z" />
                    </svg>
                    Transaction Records
                </h2>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead>
                        <tr class="bg-blue-100 text-gray-700">
                            <th class="px-6 py-3 text-left text-sm font-medium">#</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Customer</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Amount</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Method</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Status</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Date</th>
                            <th class="px-6 py-3 text-center text-sm font-medium">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($transactions as $transaction)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $transaction->id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $transaction->user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $transaction->total_amount }} TZS</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $transaction->payment_method }}</td>
                                <td class="px-6 py-4 text-sm">
                                    @if ($transaction->payment_status === 'Paid')
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-semibold">Paid</span>
                                    @else
                                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-semibold">Pending</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $transaction->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-center">
                                    <form method="POST" action="{{ route('admin.transactions.destroy', $transaction->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded flex items-center justify-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-gray-500">No transactions found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
