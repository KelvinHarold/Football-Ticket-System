<!-- filepath: c:\xampp\htdocs\Myproject\mtotoclinic\resources\views\admin\roles\index.blade.php -->
<x-admin-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">

                <table class="min-w-full divide-y divide-gray-200 overflow-x-auto">
                    <div class="flex justify-end px-4 py-2">
                        <a href="{{ route('admin.permissions.create') }}" class="bg-green-700 hover:bg-green-500 text-white font-bold py-2 px-4 rounded">
                            Create Permission
                        </a>
                    </div>
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($permissions as $permission)
                              <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                  {{ $permission->name }}
                            </td>

                            <td>
                                <div class="flex justify-end">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded-md">Edit</a>
                                        <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md" action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                      
                        <!-- More rows... -->
                
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>