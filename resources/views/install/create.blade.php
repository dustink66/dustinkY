<x-guest-layout>
    @seoTitle(__('DustinkY Blog system installation'))
    <x-install-card step="3">
        <x-splade-form action="{{ route('install.install', ['locale' => $locale]) }}" class="space-y-4">
            <h2 class="font-semibold leading-7 text-lg py-4 px-4 dark:text-gray-200">
                {{ __('Webmaster Info') }}
            </h2>
            <dl class="divide-y divide-gray-100 text-sm leading-6">
                <div class="flex justify-center py-2 px-4">
                    <dt class="font-medium sm:w-64 sm:flex-none sm:pr-6 leading-9 dark:text-gray-200">{{ __('Webmaster Name') }}</dt>
                    <dd class="flex justify-between gap-x-6 sm:flex-auto">
                        <x-splade-input id="name" type="text" name="name" placeholder="{{ __('Please enter the webmaster name') }}" class="w-96" autofocus />
                    </dd>
                </div>
                <div class="flex justify-center py-2 px-4">
                    <dt class="font-medium sm:w-64 sm:flex-none sm:pr-6 leading-9 dark:text-gray-200">{{ __('Webmaster Email') }}</dt>
                    <dd class="flex justify-between gap-x-6 sm:flex-auto">
                        <x-splade-input id="email" type="email" name="email" placeholder="{{ __('Please enter the webmaster email') }}" class="w-96" autofocus />
                    </dd>
                </div>
                <div class="flex justify-center py-2 px-4">
                    <dt class="font-medium sm:w-64 sm:flex-none sm:pr-6 leading-9 dark:text-gray-200">{{ __('Password') }}</dt>
                    <dd class="flex justify-between gap-x-6 sm:flex-auto">
                        <x-splade-input id="password" type="password" name="password" placeholder="{{ __('Please enter your password') }}" class="w-96" autocomplete="new-password" />
                    </dd>
                </div>
                <div class="flex justify-center py-2 px-4">
                    <dt class="font-medium sm:w-64 sm:flex-none sm:pr-6 leading-9 dark:text-gray-200">{{ __('Confirm Password') }}</dt>
                    <dd class="flex justify-between gap-x-6 sm:flex-auto">
                        <x-splade-input id="password_confirmation" type="password" name="password_confirmation" placeholder="{{ __('Please enter your password again') }}" class="w-96" />
                    </dd>
                </div>
            </dl>
            <div class="flex justify-center mt-6 gap-x-3">
                <Link href="{{ route('install.settings', ['locale' => $locale]) }}" class="bg-gray-400 px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-300">{{ __('Take a step back') }}</Link>
                <x-splade-submit class="w-full" :label="__('Take a step forward')" />
            </div>
        </x-splade-form>
    </x-install-card>
</x-guest-layout>
