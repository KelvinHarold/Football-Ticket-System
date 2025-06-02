
@role('admin')
<style>
    .hover-link {
        transition: all 0.3s ease;
        border-radius: 0.5rem;
    }
    .hover-link:hover {
        background-color: #58b368;
        color: white !important;
        transform: translateX(5px);
    }
    .hover-link:hover .icon-colored {
        color: white !important;
    }
    .dropdown-link:hover {
        background-color: #58b368;
        color: white !important;
        transform: translateX(5px);
    }
    .icon-colored {
        color: #454d66;
    }
    [x-admin-links][active] {
        background-color: #309975;
        color: white !important;
    }
    [x-admin-links][active] .icon-colored {
        color: white !important;
    }
</style>

<nav :class="{'block': open, 'hidden': !open}" class="flex-grow px-4 pb-4 md:block md:pb-0 md:overflow-y-auto bg-[#939495e2]">
  <x-admin-links :href="route('admin.index')" :active="request()->routeIs('admin.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-[#454d66]">
    <i class='bx bx-home mr-2 icon-colored'></i> Home
  </x-admin-links>

  <x-admin-links :href="route('admin.roles.index')" :active="request()->routeIs('admin.roles.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-[#454d66]">
      <i class='bx bx-shield-quarter mr-2 icon-colored'></i> Roles
  </x-admin-links>

  <x-admin-links :href="route('admin.permissions.index')" :active="request()->routeIs('admin.permissions.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-[#454d66]">
      <i class='bx bx-lock-alt mr-2 icon-colored'></i> Permissions
  </x-admin-links>

  <x-admin-links :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-[#454d66]">
      <i class='bx bx-group mr-2 icon-colored'></i> Users
  </x-admin-links>

  <x-admin-links :href="route('admin.users.create')" :active="request()->routeIs('admin.users.create')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-[#454d66]">
      <i class='bx bx-user-plus mr-2 icon-colored'></i> Add User
  </x-admin-links>

  <x-admin-links :href="route('matches.index')" :active="request()->routeIs('matches.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-[#454d66]">
      <i class='bx bx-football mr-2 icon-colored'></i> Add Matches
  </x-admin-links>

  <x-admin-links :href="route('admin.tickets.index')" :active="request()->routeIs('admin.tickets.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-[#454d66]">
    <i class='bx bx-star mr-2 icon-colored'></i> Tickets
  </x-admin-links>

  <x-admin-links :href="route('admin.transactions')" :active="request()->routeIs('admin.transactions')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-[#454d66]">
      <i class='bx bx-credit-card mr-2 icon-colored'></i> Transactions
  </x-admin-links>

  <x-admin-links :href="route('admin.suggestions')" :active="request()->routeIs('admin.suggestions')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-[#454d66]">
      <i class='fas fa-comment-dots mr-2 icon-colored'></i> Suggestions
  </x-admin-links>

  <x-admin-links :href="route('admin.sales.report')" :active="request()->routeIs('admin.sales.report')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-[#454d66]">
      <i class='bx bx-bar-chart-alt mr-2 icon-colored'></i> Reports
  </x-admin-links>
  
  <div @click.away="open = false" class="relative" x-data="{ open: false }">
      <button @click="open = !open" class="hover-link flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg focus:outline-none focus:shadow-outline text-[#454d66]">
          <i class='bx bx-user mr-2 icon-colored'></i>
          <span>{{ Auth::user()->name }}</span>
          <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1 icon-colored">
              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
      </button>
      <div
          x-show="open"
          x-transition:enter="transition ease-out duration-100"
          x-transition:enter-start="transform opacity-0 scale-95"
          x-transition:enter-end="transform opacity-100 scale-100"
          x-transition:leave="transition ease-in duration-75"
          x-transition:leave-start="transform opacity-100 scale-100"
          x-transition:leave-end="transform opacity-0 scale-95"
          class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg bg-[#808080] text-black"
      >
          <div class="px-2 py-2 rounded-md">
              <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <x-dropdown-link :href="route('logout')"
                      class="dropdown-link block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg text-black hover:bg-green-400"
                      onclick="event.preventDefault();
                               this.closest('form').submit();">
                      <i class='bx bx-log-out mr-2'></i> {{ __('Log Out') }}
                  </x-dropdown-link>
              </form>
              <a class="dropdown-link block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg text-black hover:bg-green-400" href="#">
                  <i class='bx bx-link-alt mr-2'></i> Link #1
              </a>
          </div>
      </div>
  </div>
</nav>
@endrole


@role('customer')
<style>
    .hover-link {
        transition: all 0.3s ease;
        border-radius: 0.5rem;
    }
    .hover-link:hover {
        background-color: #58b368;
        color: white !important;
        transform: translateX(5px);
    }
    .hover-link:hover .icon-colored {
        color: white !important;
    }
    .dropdown-link:hover {
        background-color: #309975 !important;
        color: white !important;
    }
    .icon-colored {
        color: #454d66;
    }
    [x-admin-links][active] {
        background-color: #309975;
        color: white !important;
    }
    [x-admin-links][active] .icon-colored {
        color: white !important;
    }
</style>
<nav :class="{'block': open, 'hidden': !open}" class="flex-grow px-4 pb-4 md:block md:pb-0 md:overflow-y-auto bg-[#939495e2]">
        <x-customer-links :href="route('customer.index')" :active="request()->route('customer.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
        <i class='bx bx-home mr-2 icon-colored'></i> Home
    </x-customer-links>

    <x-customer-links :href="route('customer.matches.index')" :active="request()->route('customer.matches.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
        <i class='bx bx-football mr-2 icon-colored'></i> All Matches
    </x-customer-links>

    <x-customer-links :href="route('customer.pastmatches')" :active="request()->route('customer.pastmatches')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
        <i class='bx bx-football mr-2 icon-colored'></i> Past-Matches
    </x-customer-links>

      <x-customer-links :href="route('customer.suggestions')" :active="request()->route('customer.suggestions')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
        <i class='fas fa-comment-dots mr-2 icon-colored'></i> Suggestion
    </x-customer-links>

      <x-customer-links :href="route('ticket.form')" :active="request()->route('ticket.form')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
        <i class='fas fa-ticket-alt mr-2 icon-colored'></i> Book-Ticket
    </x-customer-links>

    <x-customer-links :href="route('booking.history')" :active="request()->route('booking.history')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
        <i class='fas fa-ticket-alt mr-2 icon-colored'></i> Booking-History
    </x-customer-links>
<div @click.away="open = false" class="relative" x-data="{ open: false }">
    <button @click="open = !open" class="hover-link flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
        <i class='bx bx-user mr-2 icon-colored'></i>
        <span>{{ Auth::user()->name }}</span>
        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1 icon-colored">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
    </button>
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg bg-[#808080] text-white"
    >
        <div class="px-2 py-2 rounded-md">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')"
                    class="dropdown-link block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg text-white hover:bg-blue-600"
                    onclick="event.preventDefault();
                             this.closest('form').submit();">
                    <i class='bx bx-log-out mr-2 icon-colored'></i> {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
            <a class="dropdown-link block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg text-white hover:bg-blue-600" href="#">
                <i class='bx bx-link-alt mr-2 icon-colored'></i> Link #1
            </a>
        </div>
    </div>
</div>

</nav>
@endrole





