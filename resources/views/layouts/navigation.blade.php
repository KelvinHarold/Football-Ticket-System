<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center space-x-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        <span class="text-xl font-semibold text-blue-400">Santiago Bernabeu</span>
                    </a>
                </div>
                
                
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    <div class="flex items-center text-blue-400 font-semibold text-lg">
                        <p class="user-name-decor">Welcome: {{ Auth::user()->name }}</p>
                    </div>

                    <!--Commented
                    @role('admin')
                    <x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')" class="nav-item flex items-center">
                        <i class='bx bx-user-circle text-lg me-1 icon-colored'></i> {{ __('Admin') }}
                    </x-nav-link>
                    @endrole

                   
                    @role('doctor')
                    <x-nav-link :href="route('doctor.index')" :active="request()->routeIs('doctor.index')" class="nav-item flex items-center">
                        <i class='bx bx-plus-medical text-lg me-1 icon-colored'></i> {{ __('Doctor') }}
                    </x-nav-link>
                    @endrole

                    @role('children')
                    <x-nav-link :href="route('children.index')" :active="request()->routeIs('children.index')" class="nav-item flex items-center">
                        <i class='bx bx-child text-lg me-1 icon-colored'></i> {{ __('Children') }}
                    </x-nav-link>
                    @endrole

                    @role('pregnant-woman')
                    <x-nav-link :href="route('pregnant.index')" :active="request()->routeIs('pregnant.index')" class="nav-item flex items-center">
                        <i class='bx bx-female text-lg me-1 icon-colored'></i> {{ __('Pregnant') }}
                    </x-nav-link>
                    @endrole

                    @role('breastfeeding-woman')
                    <x-nav-link :href="route('breastfeeding.index')" :active="request()->routeIs('breastfeeding.index')" class="nav-item flex items-center">
                        <i class='bx bx-baby-carriage text-lg me-1 icon-colored'></i> {{ __('Breastfeeding') }}
                    </x-nav-link>
                    @endrole
                    -->
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="nav-item inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div class="flex items-center">
                                <i class='bx bx-user-circle text-lg me-1 icon-colored'></i>
                                <span>{{ Auth::user()->name }}</span>
                            </div>
                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="nav-item">
                            <i class='bx bx-user me-2 icon-colored'></i> {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" class="nav-item"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <i class='bx bx-log-out me-2 icon-colored'></i> {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="nav-item flex items-center">
                <i class='bx bx-home me-2 icon-colored'></i> {{ __('Dashboard') }}
            </x-responsive-nav-link>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 flex items-center">
                    <i class='bx bx-user-circle me-2 icon-colored'></i>
                    {{ Auth::user()->name }}
                </div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="nav-item flex items-center">
                    <i class='bx bx-user me-2 icon-colored'></i> {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" class="nav-item flex items-center"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        <i class='bx bx-log-out me-2 icon-colored'></i> {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>
    /* Custom Colors */
    .icon-colored {
        color: #388bf8;
    }
    .nav-item:hover .icon-colored {
        color: #388bf8;
    }
       
</style>

