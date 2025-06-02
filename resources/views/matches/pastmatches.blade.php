<x-admin-layout>
    <div class="max-w-6xl mx-auto mt-10 bg-white p-10 rounded-2xl shadow-lg">
        @include('components.success-message')

        <!-- Header -->
        <div class="flex items-center mb-8 border-b pb-4">
            <i class='bx bx-history text-4xl text-[#FE6700] mr-3'></i>
            <h2 class="text-3xl font-bold text-gray-800">Past Matches</h2>
        </div>

        <!-- Table -->
        @if ($matches->isEmpty())
            <div class="text-gray-600 text-lg">No past matches available.</div>
        @else
            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100 text-gray-700 text-sm font-semibold uppercase">
                        <tr>
                            <th class="py-3 px-6 text-left">#</th>
                            <th class="py-3 px-6 text-left">Home Team</th>
                            <th class="py-3 px-6 text-left">Away Team</th>
                            <th class="py-3 px-6 text-left">Result</th>
                            <th class="py-3 px-6 text-left">Date</th>
                            <th class="py-3 px-6 text-left">Stadium</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm divide-y divide-gray-100 bg-white">
                        @foreach ($matches as $index => $match)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-6">{{ $index + 1 }}</td>
                                <td class="py-3 px-6 font-medium">{{ $match->home_team }}</td>
                                <td class="py-3 px-6 font-medium">{{ $match->away_team }}</td>
                                <td class="py-3 px-6 font-semibold text-center">
                                    {{ $match->result }}
                                </td>
                                <td class="py-3 px-6">{{ \Carbon\Carbon::parse($match->match_date)->format('M d, Y h:i A') }}</td>
                                <td class="py-3 px-6">{{ $match->stadium }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Action Buttons -->
        <div class="mt-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <a href="{{ route('matches.show') }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg flex items-center w-fit">
                <i class='bx bx-arrow-back mr-2 text-lg'></i> Back to Show
            </a>

            <form action="{{ route('matches.clear') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete all matches?')">
                @csrf
                @method('DELETE')
                <button class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg flex items-center w-fit">
                    <i class='bx bx-trash mr-2 text-lg'></i> Clear All Matches
                </button>
            </form>
        </div>
    </div>
</x-admin-layout>
