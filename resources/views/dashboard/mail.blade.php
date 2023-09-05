<x-app-layout>
    @seoTitle(__('Mail Settings'))
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Mail Settings') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white bg-opacity-50 overflow-hidden shadow-sm sm:rounded-lg dark:bg-zinc-900 dark:bg-opacity-50 dark:text-gray-200 mx-auto max-w-7xl pt-4 lg:flex lg:gap-x-16 lg:px-8 backdrop-blur-sm backdrop-filter">
                <x-setting-navigation />

                <main class="px-4 pt-1 pb-6 sm:px-6 lg:flex-auto lg:px-0">
                    <div class="mx-auto max-w-2xl space-y-16 sm:space-y-20 lg:mx-0 lg:max-w-none">
                        <div>
                            <dl class="space-y-3 divide-y divide-gray-100 text-sm leading-6">
                                <x-setting-select label="{{ __('Mail Mailer') }}" attribute="MAIL_MAILER" :value="$MAIL_MAILER" :options="$MAIL_MAILERS" />
                                @if($MAIL_MAILER == 'smtp')
                                    <x-setting-input label="{{ __('Mail Host') }}" attribute="MAIL_HOST" :value="$MAIL_HOST" />
                                    <x-setting-input label="{{ __('Mail Port') }}" attribute="MAIL_PORT" :value="$MAIL_PORT" />
                                    <x-setting-input label="{{ __('Mail Username') }}" attribute="MAIL_USERNAME" :value="$MAIL_USERNAME" />
                                    <x-setting-input label="{{ __('Mail Password') }}" attribute="MAIL_PASSWORD" :value="$MAIL_PASSWORD" type="password" />
                                    <x-setting-select label="{{ __('Mail Encryption') }}" attribute="MAIL_ENCRYPTION" :value="$MAIL_ENCRYPTION" :options="$MAIL_ENCRYPTIONS" />
                                    <x-setting-input label="{{ __('Mail From Address') }}" attribute="MAIL_FROM_ADDRESS" :value="$MAIL_FROM_ADDRESS" />
                                    <div class="pt-3 sm:flex">
                                        <dt class="font-medium sm:w-64 sm:flex-none sm:pr-6 leading-9">{{ __('Mail From Name') }}</dt>
                                        <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto leading-9 text-base">
                                            {{ $MAIL_FROM_NAME }}
                                        </dd>
                                    </div>
                                @endif
                            </dl>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>
