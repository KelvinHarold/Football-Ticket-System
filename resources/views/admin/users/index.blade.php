<x-admin-layout>
    <div class="py-12 w-full">
        @if (session('success'))
        <div 
            x-data="{ show: true }" 
            x-init="setTimeout(() => show = false, 2000)" 
            x-show="show" 
            x-transition 
            class="bg-green-500 text-white font-bold rounded px-4 py-3 mb-4 flex items-center justify-between"
        >
            <span>{{ session('success') }}</span>
            <button @click="show = false" class="text-white ml-4">
                <i class='bx bx-x text-xl'></i>
            </button>
        </div>
    @endif
    
    
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex items-center justify-center mb-6">
                <i class='bx bx-group text-3xl mr-3 text-blue-600'></i>
                <h1 class="text-3xl font-bold text-gray-800">All Users</h1>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class='bx bx-user mr-1'></i> Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class='bx bx-envelope mr-1'></i> Email
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <i class='bx bx-user-circle mr-2 text-gray-400'></i>
                                        {{ $user->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <i class='bx bx-envelope mr-2 text-gray-400'></i>
                                        {{ $user->email }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('admin.users.show', $user->id) }}" 
                                           class="flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors duration-200">
                                            <i class='bx bx-shield-quarter mr-1'></i> Roles
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" 
                                              class="flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md transition-colors duration-200">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="flex items-center">
                                                <i class='bx bx-trash mr-1'></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
