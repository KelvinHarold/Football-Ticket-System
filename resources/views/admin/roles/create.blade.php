<x-admin-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">

                {{-- Back Button --}}
                <div class="flex px-4 py-2">
                    <a href="{{ route('admin.roles.index') }}" class="bg-blue-700 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded w-fit">
                        Roles Index
                    </a>
                </div>

                {{-- Role Creation Form --}}
                <div class="mt-6 p-4 bg-slate-100 rounded-lg shadow-inner">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Create a New Role</h2>

                    <form action="{{ route('admin.roles.store') }}" method="POST" class="flex flex-col w-full">
                        @csrf

                        {{-- Role Name Field --}}
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Role Name
                        </label>
                        <input type="text" id="name" name="name" placeholder="Enter role name"
                               class="border border-gray-300 rounded-md p-3 mb-6 w-1/2 focus:ring-blue-500 focus:border-blue-500"
                               required>

                        {{-- Submit Button --}}
                        <input type="submit" value="Create Role"
                               class="bg-green-700 hover:bg-green-500 text-white font-bold py-2 px-6 rounded-md w-fit transition duration-200 ease-in-out">
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-admin-layout>
