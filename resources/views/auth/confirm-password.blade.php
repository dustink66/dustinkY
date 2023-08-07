<x-guest-layout>
    @seoTitle(__('Confirm Password'))
    <x-auth-card>
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-200">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <x-splade-form action="{{ route('password.confirm') }}" class="space-y-4">
            <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Password') }}</span>
            <x-splade-input id="password" type="password" name="password" required autocomplete="current-password" placeholder="{{ __('Please enter your password') }}" />

            <div class="flex justify-end">
                <x-splade-submit :label="__('Confirm')" />
            </div>
        </x-splade-form>
    </x-auth-card>
</x-guest-layout>
