<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Picture') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Upload your profile picture (JPG/PNG, max 2MB).') }}
        </p>
    </header>

    <form method="POST" action="{{ route('profile.upload') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')

        <div>
            <input type="file" name="profile_picture" accept="image/*" required
                   class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
            @error('profile_picture')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        @if (Auth::user()->profile_picture)
            <div class="mt-4">
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                     class="h-20 w-20 object-cover rounded-full border">
            </div>
        @endif

        <x-primary-button>{{ __('Save') }}</x-primary-button>
    </form>
</section>
