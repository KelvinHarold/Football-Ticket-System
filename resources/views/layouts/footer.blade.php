<footer class="bg-blue-400 text-white py-8 mt-12 border-t border-blue-400">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 text-center sm:text-left">
            <!-- Contact Info -->
            <div>
                <h3 class="text-lg font-semibold mb-2">Contact Us</h3>
                <p class="text-sm flex items-center justify-center sm:justify-start">
                    <i class='bx bx-envelope mr-2 text-green-400'></i> info@mtotoclinic.com
                </p>
                <p class="text-sm flex items-center justify-center sm:justify-start mt-1">
                    <i class='bx bx-phone mr-2 text-green-400'></i> +255 123 456 789
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-2">Quick Links</h3>
                <ul class="text-sm space-y-1">
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="hover:text-blue-400">Logout</a></li>
                </ul>
                <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                    @csrf
                </form>
            </div>

            <!-- About -->
            <div>
                <h3 class="text-lg font-semibold mb-2">About MtotoClinic</h3>
                <p class="text-sm">MtotoClinic is dedicated to providing care and support for pregnant women, breastfeeding mothers, and children. Your health is our priority.</p>
            </div>
        </div>

        <!-- Bottom -->
        <div class="border-t border-white-700 mt-8 pt-4 text-center text-sm text-white-400">
            &copy; 2025 MtotoClinic. All rights reserved. <br>
            <span class="text-xs">Designed and developed by <span class="text-white font-semibold">JCodes Company</span></span>
        </div>
    </div>
</footer>
