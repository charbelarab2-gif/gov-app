@php
    $twoFactorEnabled = ! is_null($user->two_factor_secret);
    $twoFactorConfirmed = ! is_null($user->two_factor_confirmed_at);
@endphp

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Two-Factor Authentication') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Protect your office account with a one-time verification code during login.') }}
        </p>
    </header>

    <div class="mt-6 space-y-6">
        @if (session('status') === 'two-factor-authentication-enabled')
            <p class="text-sm text-green-600">
                {{ __('Two-factor authentication has been enabled. Scan the QR code and confirm setup with the generated code.') }}
            </p>
        @endif

        @if (session('status') === 'two-factor-authentication-confirmed')
            <p class="text-sm text-green-600">
                {{ __('Two-factor authentication is now active on your account.') }}
            </p>
        @endif

        @if (session('status') === 'two-factor-authentication-disabled')
            <p class="text-sm text-green-600">
                {{ __('Two-factor authentication has been disabled.') }}
            </p>
        @endif

        @if (session('status') === 'recovery-codes-generated')
            <p class="text-sm text-green-600">
                {{ __('Recovery codes have been regenerated.') }}
            </p>
        @endif

        @if (! $twoFactorEnabled)
            <p class="text-sm text-gray-600">
                {{ __('Two-factor authentication is currently disabled.') }}
            </p>

            <form method="POST" action="/user/two-factor-authentication">
                @csrf
                <x-primary-button>{{ __('Enable 2FA') }}</x-primary-button>
            </form>
        @else
            <p class="text-sm text-gray-600">
                {{ $twoFactorConfirmed
                    ? __('Two-factor authentication is enabled and confirmed.')
                    : __('Two-factor authentication is enabled but still needs confirmation.') }}
            </p>

            <div class="rounded-md border border-gray-200 p-4">
                <p class="mb-3 text-sm font-medium text-gray-900">
                    {{ $twoFactorConfirmed ? __('Scan this QR code in your authenticator app if you need to reconfigure it.') : __('Scan this QR code in your authenticator app.') }}
                </p>

                <div class="inline-block rounded-md bg-white p-4">
                    {!! $user->twoFactorQrCodeSvg() !!}
                </div>
            </div>

            @if (! $twoFactorConfirmed)
                <form method="POST" action="/user/confirmed-two-factor-authentication" class="space-y-3">
                    @csrf

                    <div>
                        <x-input-label for="two_factor_code" :value="__('Authenticator Code')" />
                        <x-text-input id="two_factor_code" name="code" type="text" class="mt-1 block w-full" autocomplete="one-time-code" />
                        <x-input-error class="mt-2" :messages="$errors->get('code')" />
                    </div>

                    <x-primary-button>{{ __('Confirm 2FA') }}</x-primary-button>
                </form>
            @endif

            @if ($twoFactorConfirmed)
                <div class="rounded-md border border-gray-200 p-4">
                    <p class="mb-3 text-sm font-medium text-gray-900">
                        {{ __('Recovery Codes') }}
                    </p>

                    <div class="space-y-2 rounded-md bg-gray-100 p-4 font-mono text-sm text-gray-800">
                        @foreach ($user->recoveryCodes() as $code)
                            <div>{{ $code }}</div>
                        @endforeach
                    </div>
                </div>

                <form method="POST" action="/user/two-factor-recovery-codes">
                    @csrf
                    <x-secondary-button type="submit">{{ __('Regenerate Recovery Codes') }}</x-secondary-button>
                </form>
            @endif

            <form method="POST" action="/user/two-factor-authentication">
                @csrf
                @method('DELETE')
                <x-danger-button>{{ __('Disable 2FA') }}</x-danger-button>
            </form>
        @endif
    </div>
</section>
