<x-admin-layout>
    <div class="max-w-6xl mx-auto py-10">
        @include('components.success-message')

        <!-- Page Header -->
        <div class="flex items-center justify-center mb-6">
            <i class='bx bx-football text-3xl mr-3 text-[#FE6700]'></i>
            <h2 class="text-3xl font-bold text-gray-800">All Matches</h2>
        </div>

        <!-- Matches Table -->
        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class='bx bx-shield-quarter mr-1'></i> Home Team
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class='bx bx-run mr-1'></i> Away Team
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class='bx bx-calendar-event mr-1'></i> Match Date & Time
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class='bx bx-map mr-1'></i> Stadium
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class='bx bx-cog mr-1'></i> Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($matches as $match)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $match->home_team }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $match->away_team }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($match->match_date)->format('M d, Y h:i A') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $match->stadium }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                                <a href="{{ route('matches.edit', $match->id) }}" 
                                   class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-md">
                                    <i class='bx bx-edit-alt mr-1'></i> Edit
                                </a>
                                <form action="{{ route('matches.delete', $match->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-sm rounded-md">
                                        <i class='bx bx-trash mr-1'></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                <i class='bx bx-info-circle mr-1'></i> No Matches Found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
