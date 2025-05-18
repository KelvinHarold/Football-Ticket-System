<x-admin-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">
                <div class="flex px-4 py-2">
                    <a href="{{ route('admin.roles.index') }}" class="bg-blue-700 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded w-fit">
                        Roles Index
                    </a>
                </div>

                {{-- Update Role Name --}}
                <div class="flex flex-col p-2 bg-slate-100">
                    <form action="{{ route('admin.roles.update', $role) }}" method="POST" class="flex flex-col w-full mt-10">
                        @csrf
                        @method('PUT')
                        <div>
                            <p>Role</p>
                            <input type="text" 
                                   name="name" 
                                   placeholder="Permission Name" 
                                   value="{{ $role->name }}"
                                   class="border border-gray-300 rounded-md p-2 mb-4 w-1/2" required>
                        </div>
                        <input type="submit" value="Update" class="bg-green-700 hover:bg-green-500 text-white font-bold py-2 px-4 rounded-md w-fit">
                    </form>
                </div>

                {{-- Role Permissions Display --}}
                <div class="mt-6 p-2 bg-slate-100">
                    <h2 class="text-2xl font-semibold">Role Permissions</h2>
                    <div class="flex flex-wrap gap-2 mt-4 p-2">
                        @if ($role->permissions)
                            @foreach ($role->permissions as $role_permission)
                                <form action="{{ route('admin.roles.permissions.revoke', [$role->id, $role_permission->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md">
                                        {{ $role_permission->name }}
                                    </button>
                                </form>
                            @endforeach
                        @endif 
                    </div>
                </div>

                {{-- Assign Permission Form --}}
                <div class="flex flex-col mt-6">
                    <form action="{{ route('admin.roles.permissions', $role->id) }}" method="POST" class="flex flex-col w-full">
                        @csrf
                        <label for="permission" class="block text-sm font-medium text-gray-700 mb-2">Permission</label>
                        <select id="permission" name="permission" 
                                class="border border-gray-300 rounded-md p-2 mb-4 w-1/2 focus:ring-blue-500 focus:border-blue-500">
                            @foreach ($permissions as $permission)
                                <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                        <input type="submit" value="Assign" class="bg-green-700 hover:bg-green-500 text-white font-bold py-2 px-4 rounded-md w-fit">
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-admin-layout>
