<x-admin-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">
                <div class="flex px-4 py-2">
                    <a href="{{ route('admin.roles.index') }}" class="bg-blue-700 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded w-fit">
                        Permissions Index
                    </a>
                </div>

                <div class="flex flex-col">
                    <form action="{{ route('admin.permissions.store', $permission->id) }}" method="POST" class="flex flex-col w-full mt-10">
                        @csrf
                        <div>
                        Permission Name: <input type="text" name="name" placeholder="Permission Name" class="border border-gray-300 rounded-md p-2 mb-4 w-1/2" required>
                            
                        </div>
                       
                        <input type="submit" value="Create Role" class="bg-green-700 hover:bg-green-500 text-white font-bold py-2 px-4 rounded-md w-fit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>