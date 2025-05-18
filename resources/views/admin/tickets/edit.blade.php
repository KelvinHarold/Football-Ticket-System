<x-admin-layout>
    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white shadow rounded-lg">
        <h2 class="text-xl font-bold mb-4">Edit Ticket Price</h2>

        @if (session('error'))
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.tickets.update', $price->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium">Ticket Class</label>
                <select name="class_id" class="w-full mt-1 border-gray-300 rounded">
                    @foreach ($ticketClasses as $class)
                        <option value="{{ $class->id }}" {{ $class->id == $price->class_id ? 'selected' : '' }}>
                            {{ $class->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Price (Tsh)</label>
                <input type="number" name="price" value="{{ $price->price }}" class="w-full mt-1 border-gray-300 rounded" />
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
