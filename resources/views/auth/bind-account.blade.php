<x-guest-layout>
    @seoTitle(__('Bind Account'))
    <x-auth-card>
        <x-splade-form action="{{ route('bind-account') }}" :default="$user" class="space-y-4 dark:text-gray-200">
            <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Email') }}</span>
            <x-splade-input id="email" type="email" name="email" placeholder="{{ __('Please enter your E-Mail address') }}" required autofocus />
            <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Password') }}</span>
            <x-splade-input id="password" type="password" name="password"  placeholder="{{ __('Please enter your password') }}" required autocomplete="current-password" />
            <x-splade-input id="provider" type="hidden" name="provider" />
            <x-splade-input id="provider_id" type="hidden" name="provider_id" />
            <div class="w-full">
                <x-splade-submit class="w-full" :label="$button_text" />
            </div>
            <div class="w-full">
                <button class="border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-green-300 hover:bg-green-500 text-white border-transparent focus:border-green-300 focus:ring-green-200 w-full">
                    <Link href="{{ route('bind-or-register') }}" class="flex flex-row items-center justify-center">
                        <span class=""> {{ __('No account, register and bind now') }}</span>
                    </Link>
                </button>
            </div>
        </x-splade-form>
    </x-auth-card>
</x-guest-layout>
