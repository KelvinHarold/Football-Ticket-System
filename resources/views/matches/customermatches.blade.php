<x-customer-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        @include('components.success-message')

        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row items-center justify-between mb-8 gap-4">
            <div class="flex items-center">
                <div class="p-3 rounded-lg mr-4">
                    <i class='bx bx-football text-3xl text-white'></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-white">All Matches</h2>
                    <p class="text-sm text-white">View and manage upcoming matches</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <div class="relative">
                    <input type="text" placeholder="Search matches..."
                        class="pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FE6700]/50 focus:border-[#FE6700] w-full sm:w-64">
                    <i class='bx bx-search absolute left-3 top-2.5 text-gray-400'></i>
                </div>
            </div>
        </div>

        <!-- Table Container with Single Transition -->
        <div
            x-data="{ showTable: false }"
            x-init="setTimeout(() => showTable = true, 300)"
            x-show="showTable"
            x-transition:enter="transition ease-out duration-700"
            x-transition:enter-start="opacity-0 translate-y-6"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden"
        >
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class='bx bx-shield-quarter mr-2 text-[#FE6700]'></i>
                                    <span>Home Team</span>
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class='bx bx-run mr-2 text-[#FE6700]'></i>
                                    <span>Away Team</span>
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class='bx bx-calendar-event mr-2 text-[#FE6700]'></i>
                                    <span>Match Date & Time</span>
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <i class='bx bx-map mr-2 text-[#FE6700]'></i>
                                    <span>Stadium</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($matches as $match)
                            <tr class="hover:bg-gray-50/50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center mr-3">
                                            <i class='bx bx-home text-gray-500'></i>
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $match->home_team }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center mr-3">
                                            <i class='bx bx-away text-gray-500'></i>
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $match->away_team }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center mr-3">
                                            <i class='bx bx-time-five text-gray-500'></i>
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($match->match_date)->format('M d, Y') }}</div>
                                            <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($match->match_date)->format('h:i A') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center mr-3">
                                            <i class='bx bx-map-pin text-gray-500'></i>
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $match->stadium }}</span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-400">
                                        <i class='bx bx-football text-5xl mb-3'></i>
                                        <h3 class="text-lg font-medium">No matches scheduled yet</h3>
                                        <p class="text-sm mt-1">Add matches to see them listed here</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-customer-layout>
