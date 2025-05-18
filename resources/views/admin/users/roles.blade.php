<x-admin-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-center mb-6">
                <i class='bx bx-id-card text-3xl mr-3 text-[#FE6700]'></i>
                <h1 class="text-3xl font-bold text-gray-800">User Role & Permission</h1>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <div class="flex px-4 py-2">
                    <a href="{{ route('admin.roles.index') }}" class="bg-blue-700 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded w-fit">
                        <i class='bx bx-arrow-back'></i> Back to User Index
                    </a>
                </div>

                {{-- User Details --}}
                <div class="p-4 bg-slate-100 mt-4 rounded">
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                </div>

                {{-- User Roles --}}
                <div class="mt-6 p-4 bg-slate-100 rounded">
                    <h2 class="text-2xl font-semibold mb-4 flex items-center"><i class='bx bx-group mr-2'></i> Roles</h2>

                    <div class="flex flex-wrap gap-2 mb-4">
                        @if($user->roles)
                            @foreach ($user->roles as $user_role)
                                <form action="{{ route('admin.users.roles.remove', [$user->id, $user_role->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md">
                                        {{ $user_role->name }}
                                    </button>
                                </form>
                            @endforeach
                        @else
                            <p class="text-gray-500">No roles assigned.</p>
                        @endif
                    </div>

                    <form action="{{ route('admin.users.roles', $user->id) }}" method="POST" class="flex flex-col w-full">
                        @csrf
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Assign Role</label>
                        <select id="role" name="role" class="border border-gray-300 rounded-md p-2 mb-4 w-1/2 focus:ring-blue-500 focus:border-blue-500">
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <input type="submit" value="Assign" class="bg-green-700 hover:bg-green-500 text-white font-bold py-2 px-4 rounded-md w-fit">
                    </form>
                </div>

                {{-- Permissions --}}
                <div class="mt-6 p-4 bg-slate-100 rounded">
                    <h2 class="text-2xl font-semibold mb-4 flex items-center"><i class='bx bx-key mr-2'></i> Permissions</h2>

                    <div class="flex flex-wrap gap-2 mb-4">
                        @if ($user->permissions)
                            @foreach ($user->permissions as $user_permission)
                                <form action="{{ route('admin.users.permissions.revoke', [$user->id, $user_permission->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md">
                                        {{ $user_permission->name }}
                                    </button>
                                </form>
                            @endforeach
                        @else
                            <p class="text-gray-500">No permissions assigned.</p>
                        @endif
                    </div>

                    <form action="{{ route('admin.users.permissions', $user->id) }}" method="POST" class="flex flex-col w-full">
                        @csrf
                        <label for="permission" class="block text-sm font-medium text-gray-700 mb-2">Assign Permission</label>
                        <select id="permission" name="permission" class="border border-gray-300 rounded-md p-2 mb-4 w-1/2 focus:ring-blue-500 focus:border-blue-500">
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
