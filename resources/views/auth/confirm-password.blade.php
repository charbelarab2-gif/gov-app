<!-- Confirm password page layout -->
<x-guest-layout>
<!-- Message asking user to confirm password -->
    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>
    {{-- Form to confirm user password --}}
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password input field -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
        <!-- Confirm password button -->
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
