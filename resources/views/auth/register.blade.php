<x-guest-layout>
    @seoTitle(__('Register'))
    <x-auth-card>
        <x-splade-form action="{{ route('register') }}" class="space-y-4 dark:text-gray-200">
            <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Name') }}</span>
            <x-splade-input id="name" type="text" name="name" placeholder="{{ __('Please enter your name') }}" required autofocus />
            <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Email') }}</span>
            <x-splade-input id="email" type="email" name="email" placeholder="{{ __('Please enter your E-Mail address') }}" required />
            <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Password') }}</span>
            <x-splade-input id="password" type="password" name="password" placeholder="{{ __('Please enter your password') }}" required autocomplete="new-password" />
            <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Confirm Password') }}</span>
            <x-splade-input id="password_confirmation" type="password" name="password_confirmation" placeholder="{{ __('Please enter your password again') }}" required />

            <div class="flex justify-between">
                <Link  href="{{ route('login') }}">
                    <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Return to login') }}</span>
                </Link>
                @if (Route::has('password.request'))
                    <Link href="{{ route('password.request') }}">
                        <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Reset Password') }}</span>
                    </Link>
                @endif
            </div>

            <div class="w-full lg:pb-4">
                <x-splade-submit class="w-full" :label="__('Register')" />
            </div>

            @if(env('SOCIALITE_ENABLED'))
                @include('auth.other-login-methods')
            @endif
        </x-splade-form>
    </x-auth-card>
</x-guest-layout>
