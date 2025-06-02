<x-customer-layout>
    <div class="max-w-2xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-full mb-3">
                <i class='bx bx-comment-detail text-white text-2xl'></i>
            </div>
            <h1 class="text-2xl font-bold text-white mb-1">Share Your Suggestions</h1>
            <p class="text-sm text-white">We value your feedback to improve our services</p>
        </div>

        <!-- Success Message -->
        @include('components.success-message')

        <!-- Suggestion Form -->
        <form 
            action="{{ route('customer.suggestions.store') }}" 
            method="POST"
            class="bg-white border border-gray-100 p-6 rounded-lg shadow-sm transition duration-300 hover:shadow-md"
        >
            @csrf
            
            <!-- Suggestion Field -->
            <div class="mb-5">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class='bx bx-edit text-gray-500 mr-1'></i> Your Suggestion
                </label>
                <textarea 
                    name="content" 
                    id="content" 
                    rows="5"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#FE6700] focus:border-[#FE6700] transition resize-none"
                    placeholder="What suggestions or ideas do you have for us?...">{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class='bx bx-error-circle mr-1'></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Footer -->
            <div class="flex items-center justify-between pt-3 border-t border-gray-100 mt-6">
                <p class="text-xs text-gray-500">
                    <i class='bx bx-lock-alt mr-1'></i> Your feedback is confidential
                </p>
                <button 
                    type="submit"
                    class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-[#FE6700] hover:bg-[#e65d00] rounded-md transition"
                >
                    <i class='bx bx-send mr-2 text-base'></i> Submit
                </button>
            </div>
        </form>

        <!-- Info Note -->
        <p class="text-center text-xs text-gray-400 mt-6 flex justify-center items-center">
            <i class='bx bx-time-five mr-1'></i> We typically respond within 3–5 business days.
        </p>
    </div>
</x-customer-layout>
