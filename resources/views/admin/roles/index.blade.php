<x-admin-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">

                {{-- Header Button --}}
                <div class="flex justify-end mb-4">
                    <a href="{{ route('admin.roles.create') }}" class="bg-green-700 hover:bg-green-500 text-white font-bold py-2 px-4 rounded-md flex items-center gap-2 transition duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Create Role
                    </a>
                </div>

                {{-- Roles Table --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border border-gray-200 rounded-md shadow-sm">
                        <thead class="bg-slate-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wide">
                                    Role Name
                                </th>
                                <th class="px-6 py-3 text-right text-sm font-medium text-gray-700 uppercase tracking-wide">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach ($roles as $role)
                                <tr>
                                    <td class="px-6 py-4 text-gray-800">
                                        {{ $role->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end space-x-2">
                                            {{-- Edit --}}
                                            <a href="{{ route('admin.roles.edit', $role->id) }}"
                                               class="px-4 py-2 bg-blue-600 hover:bg-blue-400 text-white rounded-md flex items-center gap-2 transition duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                </svg>
                                                Edit
                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete this role?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="px-4 py-2 bg-red-600 hover:bg-red-400 text-white rounded-md flex items-center gap-2 transition duration-200">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0a2 2 0 00-2-2H9a2 2 0 00-2 2m10 0H5"></path>
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @if($roles->isEmpty())
                                <tr>
                                    <td colspan="2" class="px-6 py-4 text-center text-gray-500">No roles found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-admin-layout>
