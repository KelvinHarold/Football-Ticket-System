<x-customer-layout>
    <div class="max-w-md mx-auto mt-10 bg-white p-8 rounded-xl shadow-md">
        <h2 class="text-2xl font-bold text-center text-blue-700 mb-6">
             @include('components.success-message')
            SantiagoBernabeu - Book Your Ticket
        </h2>
        <form action="{{ route('ticket.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="ticket_class" class="block text-sm font-medium text-gray-700">Select Ticket Class:</label>
                <select id="ticket_class" name="ticket_class" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Select Class --</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="cost" class="block text-sm font-medium text-gray-700">Ticket Cost:</label>
                <input type="text" id="cost" name="cost" readonly required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method:</label>
                <select name="payment_method" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Select Payment Method --</option>
                    <option value="Halopesa">Halopesa</option>
                    <option value="Tigopesa">Tigopesa</option>
                    <option value="M-pesa">M-pesa</option>
                </select>
            </div>

            <button type="submit"
                class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md shadow">
                <i class="fas fa-ticket-alt"></i> Book Ticket
            </button>
        </form>
    </div>

    <script>
        document.getElementById('ticket_class').addEventListener('change', function () {
            const classId = this.value;
            const costInput = document.getElementById('cost');

            if (classId) {
                fetch(`/get-price-by-class/${classId}`)
                    .then(response => response.json())
                    .then(data => {
                        costInput.value = data.price ?? '';
                    });
            } else {
                costInput.value = '';
            }
        });
    </script>
</x-customer-layout>
