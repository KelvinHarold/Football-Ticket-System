<x-customer-layout>
    <div class="max-w-7xl mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Booking History</h2>

        <table class="min-w-full bg-white shadow rounded-lg">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2">User</th>
                    <th class="px-4 py-2">Ticket Code</th>
                    <th class="px-4 py-2">Date Booked</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($histories as $history)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $history->user->name }}</td>
                    <td class="px-4 py-2">{{ $history->ticket->ticket_code }}</td>
                    <td class="px-4 py-2">{{ $history->date_booked }}</td>
                    <td class="px-4 py-2">{{ ucfirst($history->status) }}</td>
                    <td class="px-4 py-2">
                        <form action="{{ route('booking.history.delete', $history->id) }}" method="POST" onsubmit="return confirm('Delete this record?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-customer-layout>
