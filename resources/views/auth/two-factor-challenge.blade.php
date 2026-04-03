<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Enter the authentication code from your authenticator app to finish signing in.') }}
    </div>
<!-- Display validation errors -->
    @if ($errors->any())
        <div class="mb-4 text-sm text-red-600">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<!-- form to verify two-factor authentication code -->
    <form method="POST" action="{{ route('two-factor.login.store') }}">
        @csrf

        <div>
            <!-- Authentication code input -->
            <x-input-label for="code" :value="__('Authentication Code')" />
            <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" autofocus autocomplete="one-time-code" />
        </div>

        <div class="mt-4">
            <!-- Recovery code input -->
            <x-input-label for="recovery_code" :value="__('Recovery Code (optional)')" />
            <x-text-input id="recovery_code" class="block mt-1 w-full" type="text" name="recovery_code" autocomplete="one-time-code" />
        </div>

        <div class="flex items-center justify-end mt-4">
   <!-- verify and login button -->
            <x-primary-button>
                {{ __('Verify and Log In') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
