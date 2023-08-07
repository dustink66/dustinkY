<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-200">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <x-splade-form method="put" :action="route('password.update')" class="mt-6 space-y-6" preserve-scroll>
        <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Current Password') }}</span>
        <x-splade-input id="current_password" name="current_password" type="password" placeholder="{{ __('Please enter your current password') }}" autocomplete="current-password" />
        <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('New Password') }}</span>
        <x-splade-input id="password" name="password" type="password" placeholder="{{ __('Please enter your new password') }}" autocomplete="new-password" />
        <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Confirm Password') }}</span>
        <x-splade-input id="password_confirmation" name="password_confirmation" type="password" placeholder="{{ __('Please enter your new password again') }}" autocomplete="new-password" />

        <div class="flex items-center gap-4">
            <x-splade-submit :label="__('Save')" />

            @if (session('status') === 'password-updated')
                <p class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </x-splade-form>
</section>
