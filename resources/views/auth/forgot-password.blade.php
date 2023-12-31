<x-guest-layout>
    @seoTitle(__('Reset Password'))
    <x-auth-card>
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-200">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" />

        <x-splade-form action="{{ route('password.email') }}" class="space-y-4">
            <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Email') }}</span>
            <x-splade-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="{{ __('Please enter your E-Mail address') }}" required autofocus />

            <div class="flex items-center justify-end">
                <x-splade-submit :label="__('Email Password Reset Link')" />
            </div>
        </x-splade-form>
    </x-auth-card>
</x-guest-layout>
