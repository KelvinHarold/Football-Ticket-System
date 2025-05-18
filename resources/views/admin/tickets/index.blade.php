<x-admin-layout>
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow rounded-lg">
        <h2 class="text-xl font-bold mb-4">Manage Ticket Classes and Prices</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- Add Ticket Class Form --}}
        <div class="mb-10 p-6 bg-gray-50 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Add Ticket Class</h3>

            <form method="POST" action="{{ route('admin.ticket-classes.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium">Class Name</label>
                    <select name="name" class="w-full border-gray-300 rounded mt-1" required>
                        <option value="" disabled selected>Select Class</option>
                        <option value="General">General</option>
                        <option value="VIP">VIP</option>
                    </select>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">Description (optional)</label>
                    <textarea name="description" rows="2" class="w-full border-gray-300 rounded mt-1"></textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Add Ticket Class
                </button>
            </form>
        </div>

        {{-- Set Ticket Price Form --}}
        <div class="mb-10 p-6 bg-gray-50 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Set Ticket Price</h3>

            <form action="{{ route('admin.tickets.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium">Ticket Class</label>
                        <select name="class_id" class="w-full mt-1 border-gray-300 rounded" required>
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
                        <label class="block text-sm font-medium">Price (Tsh)</label>
                        <input type="number" name="price" class="w-full mt-1 border-gray-300 rounded" required min="0" />
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 text-right">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Save Price
                    </button>
                </div>
            </form>
        </div>

        {{-- Table of Existing Prices --}}
        <h2 class="text-xl font-bold mb-4">Existing Ticket Prices</h2>

        <table class="w-full border text-sm">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2">Ticket Class</th>
                    <th class="px-4 py-2">Price (Tsh)</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ticketPrices as $price)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $price->ticketClass->name }}</td>
                        <td class="px-4 py-2">{{ number_format($price->price) }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('admin.tickets.edit', $price->id) }}" class="text-blue-600 hover:underline">
                                Edit
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-admin-layout>
