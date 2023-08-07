<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-200">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <x-splade-form method="patch" :action="route('profile.update')" :default="$user" class="mt-6 space-y-6" preserve-scroll>
        <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Name') }}</span>
        <x-splade-input id="name" name="name" type="text" placeholder="{{ __('Please enter your name') }}" required autofocus autocomplete="name" />
        <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Email') }}</span>
        <x-splade-input id="email" name="email" type="email" placeholder="{{ __('Please enter your E-Mail address') }}" required autocomplete="email" />
        <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Avatar') }}</span>
        <UploadImage check-url="{{ route('upload.check_exists') }}" is-avatar="true" upload-url="{{ route('upload.image') }}" input-key="avatar" button-text="{{ __('Upload avatar') }}" save-url="{{ route('profile.update') }}" image-url="{{ $user->avatar }}" class="py-4"/>


        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800">
                    {{ __('Your email address is unverified.') }}

                    <Link method="post" href="{{ route('verification.send') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:text-gray-200 dark:hover:text-gray-400">
                        {{ __('Click here to re-send the verification email.') }}
                    </Link>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-200">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            </div>
        @endif

        <div class="flex items-center gap-4">
            <x-splade-submit :label="__('Save')" />

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-gray-600 dark:text-gray-200">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </x-splade-form>
</section>
