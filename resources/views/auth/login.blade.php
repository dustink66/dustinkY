<x-guest-layout>
    @seoTitle(__('Login'))
    <x-auth-card>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" />

        <x-splade-form action="{{ route('login') }}?callback={{ $callback }}" class="space-y-4">
            <!-- Email Address -->
            <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Email') }}</span>
            <x-splade-input id="email" type="email" name="email" placeholder="{{ __('Please enter your E-Mail address') }}" required autofocus />
            <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Password') }}</span>
            <x-splade-input id="password" type="password" name="password"  placeholder="{{ __('Please enter your password') }}" required autocomplete="current-password" />

            <div class="flex justify-between">
                @if (Route::has('register'))
                    <Link  href="{{ route('register') }}">
                        <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Register an account') }}</span>
                    </Link>
                @endif
                @if (Route::has('password.request'))
                    <Link href="{{ route('password.request') }}">
                        <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Reset Password') }}</span>
                    </Link>
                @endif
            </div>

            <div class="w-full lg:pb-4">
                <x-splade-submit class="w-full" :label="__('Log in')" />
            </div>

            @if(env('SOCIALITE_ENABLED'))
                @include('auth.other-login-methods')
            @endif
        </x-splade-form>
    </x-auth-card>
</x-guest-layout>
