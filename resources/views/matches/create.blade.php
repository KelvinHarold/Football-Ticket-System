<x-admin-layout>
    <div class="max-w-5xl mx-auto mt-10 bg-white p-10 rounded-2xl shadow-lg">
        @include('components.success-message')

        <!-- Header -->
        <div class="flex items-center mb-8 border-b pb-4">
            <i class='bx bx-football text-4xl text-[#FE6700] mr-3'></i>
            <h2 class="text-3xl font-bold text-gray-800">Add New Match</h2>
        </div>

        <!-- Form -->
        <form action="{{ route('matches.store') }}" method="POST" class="space-y-8">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Home Team -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class='bx bx-home text-[#FE6700] mr-1'></i> Home Team
                    </label>
                    <div class="relative">
                        <i class='bx bx-football absolute left-3 top-3.5 text-gray-400'></i>
                        <input type="text" name="home_team" class="w-full pl-10 pr-4 py-3 border rounded-xl focus:ring-2 focus:ring-purple-500" placeholder="e.g., Simba SC" required>
                    </div>
                </div>

                <!-- Away Team -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class='bx bx-right-arrow-alt text-[#FE6700] mr-1'></i> Away Team
                    </label>
                    <div class="relative">
                        <i class='bx bx-football absolute left-3 top-3.5 text-gray-400'></i>
                        <input type="text" name="away_team" class="w-full pl-10 pr-4 py-3 border rounded-xl focus:ring-2 focus:ring-purple-500" placeholder="e.g., Yanga SC" required>
                    </div>
                </div>

                <!-- Match Date -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class='bx bx-calendar text-[#FE6700] mr-1'></i> Match Date & Time
                    </label>
                    <div class="relative">
                        <i class='bx bx-calendar-event absolute left-3 top-3.5 text-gray-400'></i>
                        <input type="datetime-local" name="match_date" class="w-full pl-10 pr-4 py-3 border rounded-xl focus:ring-2 focus:ring-purple-500" required>
                    </div>
                </div>

                <!-- Stadium -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class='bx bx-building-house text-[#FE6700] mr-1'></i> Stadium
                    </label>
                    <div class="relative">
                        <i class='bx bx-map-pin absolute left-3 top-3.5 text-gray-400'></i>
                        <input type="text" name="stadium" class="w-full pl-10 pr-4 py-3 border rounded-xl focus:ring-2 focus:ring-purple-500" placeholder="e.g., Benjamin Mkapa" required>
                    </div>
                </div>

            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap justify-between items-center gap-4 mt-8">
                <a href="{{ route('matches.show') }}" class="flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl">
                    <i class='bx bx-list-ul mr-2 text-xl'></i> View All Matches
                </a>

                <a href="{{ route('matches.past') }}" class="flex items-center px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-xl">
                    <i class='bx bx-history mr-2 text-xl'></i> Past Matches
                </a>

                <button type="submit" class="flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-xl">
                    <i class='bx bx-upload mr-2 text-xl'></i> Upload Match
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
