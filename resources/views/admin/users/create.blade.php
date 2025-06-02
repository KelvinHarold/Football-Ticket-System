<x-admin-layout>
    <div class="max-w-6xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-[0_10px_25px_-5px_rgba(0,0,0,0.1),0_10px_10px_-5px_rgba(0,0,0,0.04)]">
        <div class="flex items-center mb-8">
            <i class='bx bx-user-plus text-3xl mr-3 text-[#FE6700]'></i>
            <h2 class="text-3xl font-bold">Register New User</h2>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name Field -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                        <i class='bx bx-user mr-2 text-[#FE6700]'></i> Full Name
                    </label>
                    <div class="relative">
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 ease-in-out" 
                            placeholder="John Doe"
                            required>
                        <i class='bx bx-user absolute left-3 top-3.5 text-gray-400'></i>
                    </div>
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                        <i class='bx bx-envelope mr-2 text-[#FE6700]'></i> Email Address
                    </label>
                    <div class="relative">
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 ease-in-out" 
                            placeholder="example@email.com"
                            required>
                        <i class='bx bx-envelope absolute left-3 top-3.5 text-gray-400'></i>
                    </div>
                </div>

                <!-- Phone Field -->
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                        <i class='bx bx-phone mr-2 text-[#FE6700]'></i> Phone
                    </label>
                    <div class="relative">
                        <input 
                            type="tel" 
                            name="phone" 
                            id="phone" 
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 ease-in-out" 
                            placeholder="+255"
                            required>
                        <i class='bx bx-phone absolute left-3 top-3.5 text-gray-400'></i>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                        <i class='bx bx-lock-alt mr-2 text-[#FE6700]'></i> Password
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 ease-in-out" 
                            placeholder="••••••••"
                            required>
                        <i class='bx bx-lock-alt absolute left-3 top-3.5 text-gray-400'></i>
                    </div>
                </div>

                <!-- Confirm Password Field -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                        <i class='bx bx-check-shield mr-2 text-[#FE6700]'></i> Confirm Password
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="password_confirmation" 
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 ease-in-out" 
                            placeholder="••••••••"
                            required>
                        <i class='bx bx-check-shield absolute left-3 top-3.5 text-gray-400'></i>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-8">
                <button type="submit" class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg shadow-md transition-all duration-300 ease-in-out flex items-center">
                    <i class='bx bx-user-plus mr-2'></i> Register User
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
