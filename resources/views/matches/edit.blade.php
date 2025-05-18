<x-admin-layout>
    @include('components.success-message')

    <div class="max-w-4xl mx-auto mt-10 p-8 bg-white shadow-xl rounded-xl border border-gray-200">
        <div class="flex items-center justify-center mb-6">
            <i class='bx bx-edit-alt text-3xl mr-3 text-[#FE6700]'></i>
            <h2 class="text-3xl font-bold text-gray-800">Edit Match</h2>
        </div>

        <form action="{{ route('matches.update', $matches->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="relative">
                <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                    <i class='bx bx-shield-quarter mr-2 text-[#FE6700]'></i> Home Team
                </label>
                <input 
                    type="text" 
                    name="home_team" 
                    value="{{ old('home_team', $matches->home_team) }}"
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200" 
                    required
                >
                <i class='bx bx-shield-quarter absolute left-3 top-10 text-gray-400'></i>
            </div>

            <div class="relative">
                <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                    <i class='bx bx-run mr-2 text-[#FE6700]'></i> Away Team
                </label>
                <input 
                    type="text" 
                    name="away_team" 
                    value="{{ old('away_team', $matches->away_team) }}"
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200" 
                    required
                >
                <i class='bx bx-run absolute left-3 top-10 text-gray-400'></i>
            </div>

            <div class="relative">
                <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                    <i class='bx bx-calendar-event mr-2 text-[#FE6700]'></i> Match Date & Time
                </label>
                <input 
                    type="datetime-local" 
                    name="match_date" 
                    value="{{ old('match_date', \Carbon\Carbon::parse($matches->match_date)->format('Y-m-d\TH:i')) }}"
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200" 
                    required
                >
                <i class='bx bx-calendar-event absolute left-3 top-10 text-gray-400'></i>
            </div>

            <div class="relative">
                <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                    <i class='bx bx-map mr-2 text-[#FE6700]'></i> Stadium
                </label>
                <input 
                    type="text" 
                    name="stadium" 
                    value="{{ old('stadium', $matches->stadium) }}"
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200" 
                    required
                >
                <i class='bx bx-map absolute left-3 top-10 text-gray-400'></i>
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <a href="{{ route('matches.show') }}"
                    class="flex items-center px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-lg transition duration-200 shadow-md">
                    <i class='bx bx-x mr-2'></i> Cancel
                </a>
                <button type="submit"
                    class="flex items-center px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition duration-200 shadow-md">
                    <i class='bx bx-save mr-2'></i> Update
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
