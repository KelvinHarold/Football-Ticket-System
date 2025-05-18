<x-admin-layout>
    <div class="max-w-6xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-[0_10px_25px_-5px_rgba(0,0,0,0.1),0_10px_10px_-5px_rgba(0,0,0,0.04)]">
        @include('components.success-message')

        <div class="flex items-center mb-8">
            <i class='bx bx-football text-3xl mr-3 text-[#FE6700]'></i>
            <h2 class="text-3xl font-bold">Add Match</h2>
        </div>

        <form action="{{ route('matches.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Home Team -->
                <div>
                    <label for="home_team" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                        <i class='bx bx-home mr-2 text-[#FE6700]'></i> Home Team
                    </label>
                    <div class="relative">
                        <input 
                            type="text" 
                            name="home_team" 
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 ease-in-out" 
                            placeholder="Enter home team"
                            required>
                        <i class='bx bx-home absolute left-3 top-3.5 text-gray-400'></i>
                    </div>
                </div>

                <!-- Away Team -->
                <div>
                    <label for="away_team" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                        <i class='bx bx-right-arrow-alt mr-2 text-[#FE6700]'></i> Away Team
                    </label>
                    <div class="relative">
                        <input 
                            type="text" 
                            name="away_team" 
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 ease-in-out" 
                            placeholder="Enter away team"
                            required>
                        <i class='bx bx-right-arrow-alt absolute left-3 top-3.5 text-gray-400'></i>
                    </div>
                </div>

                <!-- Match Date & Time -->
<div>
    <label for="match_date" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
        <i class='bx bx-calendar mr-2 text-[#FE6700]'></i> Match Date & Time
    </label>
    <div class="relative">
        <input 
            type="datetime-local" 
            name="match_date" 
            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 ease-in-out"
            required>
        <i class='bx bx-calendar absolute left-3 top-3.5 text-gray-400'></i>
    </div>
</div>

                <!-- Stadium -->
                <div>
                    <label for="stadium" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                        <i class='bx bx-building-house mr-2 text-[#FE6700]'></i> Stadium
                    </label>
                    <div class="relative">
                        <input 
                            type="text" 
                            name="stadium" 
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 ease-in-out" 
                            placeholder="Enter stadium name"
                            required>
                        <i class='bx bx-building-house absolute left-3 top-3.5 text-gray-400'></i>
                    </div>
                </div>
            </div>

            <!-- Submit & Navigation Buttons -->
            <div class="flex justify-between items-center mt-10">
                <a href="{{ route('matches.show') }}" 
                   class="flex items-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200">
                    <i class='bx bx-list-ul mr-2'></i> View All Matches
                </a>

                <button type="submit" 
                        class="flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow-md transition-all duration-300 ease-in-out">
                    <i class='bx bx-upload mr-2'></i> Upload Match
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
