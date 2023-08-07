<x-guest-layout>
    @seoTitle(__('Bind Account'))
    <x-auth-card>
        <x-splade-form action="{{ route('bind-or-register') }}" :default="$user" class="space-y-4 dark:text-gray-200">
            <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Name') }}</span>
            <x-splade-input id="name" type="text" name="name" placeholder="{{ __('Please enter your name') }}" required autofocus />
            <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Email') }}</span>
            <x-splade-input id="email" type="email" name="email" placeholder="{{ __('Please enter your E-Mail address') }}" required />
            <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Password') }}</span>
            <x-splade-input id="password" type="password" name="password" placeholder="{{ __('Please enter your password') }}" required autocomplete="new-password" />
            <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Confirm Password') }}</span>
            <x-splade-input id="password_confirmation" type="password" name="password_confirmation" placeholder="{{ __('Please enter your password again') }}" required />
            <x-splade-input id="provider" type="hidden" name="provider" />
            <x-splade-input id="provider_id" type="hidden" name="provider_id" />
            <div class="w-full">
                <x-splade-submit class="w-full" :label="$button_text" />
            </div>
            <div class="w-full">
                <button class="border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-green-300 hover:bg-green-500 text-white border-transparent focus:border-green-300 focus:ring-green-200 w-full">
                    <Link href="{{ route('bind-account') }}" class="flex flex-row items-center justify-center">
                        <span class=""> {{ __('Existing account, bind now') }}</span>
                    </Link>
                </button>
            </div>
        </x-splade-form>
    </x-auth-card>
</x-guest-layout>
