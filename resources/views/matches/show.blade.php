<x-admin-layout>
    <div class="max-w-6xl mx-auto py-10">
        @include('components.success-message')

        <div class="flex items-center justify-center mb-6">
            <i class='bx bx-football text-3xl mr-3 text-[#FE6700]'></i>
            <h2 class="text-3xl font-bold text-gray-800">All Matches</h2>
        </div>

        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                <i class='bx bx-shield-quarter mr-1'></i> Home Team
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                <i class='bx bx-run mr-1'></i> Away Team
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                <i class='bx bx-calendar-event mr-1'></i> Match Date & Time
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                <i class='bx bx-map mr-1'></i> Stadium
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                                <i class='bx bx-cog mr-1'></i> Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($matches as $match)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4">{{ $match->home_team }}</td>
                            <td class="px-6 py-4">{{ $match->away_team }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($match->match_date)->format('M d, Y h:i A') }}</td>
                            <td class="px-6 py-4">{{ $match->stadium }}</td>
                            <td class="px-6 py-4 text-right space-x-2">
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
                                <button type="button"
                                    data-match-id="{{ $match->id }}"
                                    data-home="{{ $match->home_team }}"
                                    data-away="{{ $match->away_team }}"
                                    data-date="{{ $match->match_date }}"
                                    data-stadium="{{ $match->stadium }}"
                                    class="inline-flex items-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-sm rounded-md open-modal-btn">
                                    <i class='bx bx-save mr-1'></i> Save Past
                                </button>
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

    <!-- Modal -->
    <div id="pastMatchModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden justify-center items-center">
        <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">Save Match as Past</h3>
            <form id="pastMatchForm" method="POST" action="{{ route('pastmatches.store') }}">
                @csrf
                <input type="hidden" name="match_id" id="modalMatchId">
                <input type="hidden" name="home_team" id="modalHome">
                <input type="hidden" name="away_team" id="modalAway">
                <input type="hidden" name="match_date" id="modalDate">
                <input type="hidden" name="stadium" id="modalStadium">

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Result</label>
                    <input type="text" name="result" required placeholder="e.g. 2-1"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" class="px-4 py-2 bg-gray-400 text-white rounded close-modal-btn">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.querySelectorAll('.open-modal-btn').forEach(button => {
            button.addEventListener('click', () => {
                document.getElementById('modalMatchId').value = button.getAttribute('data-match-id');
                document.getElementById('modalHome').value = button.getAttribute('data-home');
                document.getElementById('modalAway').value = button.getAttribute('data-away');
                document.getElementById('modalDate').value = button.getAttribute('data-date');
                document.getElementById('modalStadium').value = button.getAttribute('data-stadium');
                document.getElementById('pastMatchModal').classList.remove('hidden');
                document.getElementById('pastMatchModal').classList.add('flex');
            });
        });

        document.querySelectorAll('.close-modal-btn').forEach(button => {
            button.addEventListener('click', () => {
                document.getElementById('pastMatchModal').classList.add('hidden');
                document.getElementById('pastMatchModal').classList.remove('flex');
            });
        });
    </script>
</x-admin-layout>
