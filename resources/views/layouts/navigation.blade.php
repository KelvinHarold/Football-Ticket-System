<nav x-data="{ open: false }" class="bg-[#F5F5F5]  text-blue-900 border-b border-gray-100">
    <style>
            .icon-colored {
        color: #454d66;
    }

    .dropdown-link:hover {
        background-color: #58b368;
        color: white !important;
        transform: translateX(5px);
    }
    </style>
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center space-x-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                        <x-application-logo class="block h-9 w-auto" />
                        <span class="text-xl font-semibold text-blue-900">Santiago Bernabeu</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <div class="flex items-center font-semibold text-lg">
                        <p class="user-name-decor text-blue-900">Welcome: {{ Auth::user()->name }}</p>
                    </div>
                </div>
            </div>

            <!-- Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="nav-item inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-900 bg-[#F5F5F5] focus:outline-none transition ease-in-out duration-150">
                            @if (Auth::user()->profile_picture)
                                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="h-8 w-8 object-cover rounded-full border me-2">
                            @else
                                <i class="fas fa-user-circle text-2xl text-white me-2 icon-colored"></i>
                            @endif
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="ms-2 -me-0.5 h-4 w-4 text-blue-900" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="bg-white  rounded-md shadow-md p-2 ">
                            <x-dropdown-link 
                                :href="route('profile.edit')" 
                                class="flex items-center space-x-2 px-4 py-2 rounded-md"
                            >
                                <i class="fas fa-user text-blue-900 icon-colored"></i>
                                <span>{{ __('Profile') }}</span>
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link 
                                    :href="route('logout')" 
                                    class="flex items-center space-x-2 px-4 py-2 rounded-md"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                >
                                    <i class="fas fa-sign-out-alt text-white icon-colored"></i>
                                    <span>{{ __('Log Out') }}</span>
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>
    </div>
</nav>