<x-guest-layout>
    @seoTitle(__('Reset Password'))
    <x-auth-card>
        <x-splade-form :default="['email' => $request->email, 'token' => $request->route('token')]" action="{{ route('password.store') }}" class="space-y-4">
            <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Email') }}</span>
            <x-splade-input id="email" type="email" name="email" placeholder="{{ __('Please enter your E-Mail address') }}" required autofocus />
            <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Password') }}</span>
            <x-splade-input id="password" type="password" name="password" placeholder="{{ __('Please enter your password') }}" required />
            <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Confirm Password') }}</span>
            <x-splade-input id="password_confirmation" type="password" name="password_confirmation" placeholder="{{ __('Please enter your password again') }}" required />

            <div class="flex items-center justify-end">
                <x-splade-submit :label="__('Reset Password')" />
            </div>
        </x-splade-form>
    </x-auth-card>
</x-guest-layout>
