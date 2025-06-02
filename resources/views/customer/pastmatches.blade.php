<x-customer-layout>
    @include('components.success-message')

    <!-- Header -->
    <div class="flex items-center mb-6">
        <i class='bx bx-history text-3xl text-white mr-2'></i>
        <h2 class="text-2xl font-bold text-white">Past Matches</h2>
    </div>

    <!-- Table with Transition -->
    @if ($matches->isEmpty())
        <div class="text-gray-600 text-lg">No past matches available.</div>
    @else
        <div 
            x-data="{ showTable: false }" 
            x-init="setTimeout(() => showTable = true, 200)" 
            x-show="showTable"
            x-transition:enter="transition ease-out duration-700"
            x-transition:enter-start="opacity-0 translate-y-6"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="overflow-x-auto"
        >
            <table class="min-w-full divide-y divide-gray-200 border border-gray-200 rounded-lg">
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
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="py-3 px-6">{{ $index + 1 }}</td>
                            <td class="py-3 px-6 font-medium">{{ $match->home_team }}</td>
                            <td class="py-3 px-6 font-medium">{{ $match->away_team }}</td>
                            <td class="py-3 px-6 font-semibold text-center">{{ $match->result }}</td>
                            <td class="py-3 px-6">{{ \Carbon\Carbon::parse($match->match_date)->format('M d, Y h:i A') }}</td>
                            <td class="py-3 px-6">{{ $match->stadium }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-customer-layout>
