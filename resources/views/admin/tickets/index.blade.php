<x-admin-layout>
    <div class="max-w-5xl mx-auto mt-10">
    @include('components.success-message')
        {{-- Main Card Container --}}
        <div class="bg-white rounded-2xl shadow-xl p-8 border-l-8 border-green-600 space-y-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Ticket Management</h2>

            {{-- Section 1: Add Ticket Class --}}
            <div>
                <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Add Ticket Class</h3>
                <form method="POST" action="{{ route('admin.ticket-classes.store') }}">
                    @csrf
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Class Name</label>
                        <select name="name" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-600" required>
                            <option value="" disabled selected>Select Class</option>
                            <option value="General">General</option>
                            <option value="VIP">VIP</option>
                        </select>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description (optional)</label>
                        <textarea name="description" rows="2" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-600"></textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded-lg transition">
                        Add Ticket Class
                    </button>
                </form>
            </div>

            {{-- Section 2: Set Ticket Price --}}
            <div>
                <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Set Ticket Price</h3>
                <form action="{{ route('admin.tickets.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ticket Class</label>
                            <select name="class_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                                <option disabled selected>Select class</option>
                                @foreach ($ticketClasses as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                            @error('class_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Price (Tsh)</label>
                            <input type="number" name="price" min="0" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600" required />
                            @error('price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg transition">
                            Save Price
                        </button>
                    </div>
                </form>
            </div>

            {{-- Section 3: Existing Ticket Prices --}}
            <div>
                <h3 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Existing Ticket Prices</h3>
                <table class="w-full border border-gray-200 rounded-lg text-sm">
                    <thead class="bg-indigo-50 text-indigo-700">
                        <tr>
                            <th class="px-6 py-3 text-left font-medium">Ticket Class</th>
                            <th class="px-6 py-3 text-left font-medium">Price (Tsh)</th>
                            <th class="px-6 py-3 text-left font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ticketPrices as $price)
                            <tr class="border-t border-gray-200 hover:bg-indigo-50 transition">
                                <td class="px-6 py-3">{{ $price->ticketClass->name }}</td>
                                <td class="px-6 py-3">{{ number_format($price->price) }}</td>
                               <td class="px-6 py-3">
    <a href="{{ route('admin.tickets.edit', $price->id) }}" class="text-indigo-600 hover:underline mr-4">
        Edit
    </a>

    <form action="{{ route('admin.tickets.delete', $price->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this ticket price?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-600 hover:underline">
            Delete
        </button>
    </form>
</td>

                            </tr>
                        @endforeach
                        @if($ticketPrices->isEmpty())
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">No ticket prices set yet.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
