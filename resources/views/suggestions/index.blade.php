<x-customer-layout>
    <div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-[#FE6700]/10 rounded-full mb-4">
                <i class='bx bx-comment-detail text-[#FE6700] text-3xl'></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Share Your Suggestions</h1>
            <p class="text-lg text-gray-600 max-w-md mx-auto">
                We value your feedback to improve our services
            </p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 transition-all duration-300 hover:shadow-lg">
            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class='bx bx-check-circle text-green-500 text-2xl'></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('customer.suggestions.store') }}" method="POST" class="p-6 sm:p-8">
                @csrf
                
                <!-- Suggestion Field -->
                <div class="mb-6">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                        <i class='bx bx-edit text-gray-500 mr-2'></i> Your Suggestion
                    </label>
                    <textarea 
                        name="content" 
                        id="content" 
                        rows="6"
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#FE6700] focus:border-[#FE6700] transition duration-150 ease-in-out resize-none"
                        placeholder="What suggestions or ideas do you have for us?..."
                        required
                    >{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class='bx bx-error-circle mr-1'></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Form Footer -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                    <div class="text-sm text-gray-500">
                        <i class='bx bx-lock-alt mr-1'></i> Your feedback is confidential
                    </div>
                    <button 
                        type="submit"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-[#FE6700] hover:bg-[#E55C00] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FE6700] transition duration-150 ease-in-out"
                    >
                        <i class='bx bx-send mr-2'></i> Submit Suggestion
                    </button>
                </div>
            </form>
        </div>

        <!-- Additional Info -->
        <div class="mt-8 text-center text-sm text-gray-500">
            <p class="flex items-center justify-center">
                <i class='bx bx-time-five mr-2'></i> We typically respond to suggestions within 3-5 business days
            </p>
        </div>
    </div>
</x-customer-layout>