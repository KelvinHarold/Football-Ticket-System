<x-admin-layout>
    <div class="max-w-6xl mx-auto mt-10 p-6 bg-white shadow-md rounded-xl">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
            <i class='bx bx-comment-detail text-2xl text-[#FE6700] mr-2'></i> All Suggestions
        </h1>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 text-sm text-left">
                <thead class="bg-gray-100 text-gray-700 uppercase">
                    <tr>
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border">Sender Name</th>
                        <th class="px-4 py-2 border">Suggestion</th>
                        <th class="px-4 py-2 border">Date Sent</th>
                         <th class="px-4 py-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($suggestions as $index => $suggestion)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border">{{ $suggestion->user->name ?? 'Unknown User' }}</td>
                            <td class="px-4 py-2 border">{{ $suggestion->content }}</td>
                            <td class="px-4 py-2 border">{{ $suggestion->created_at->format('d M Y, h:i A') }}</td>
                            <td class="px-4 py-2 border">
                                <a href="" 
                                   class="inline-flex items-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-sm rounded-md">
                                    <i class='bx bx-edit-alt mr-1'></i> FeedBack
                                </a>
                                <form action="" method="POST" class="inline">
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
                            <td colspan="4" class="px-4 py-4 text-center text-gray-500">No suggestions available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
