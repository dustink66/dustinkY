<x-app-layout>
    @seoTitle(__('Secure Settings'))
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Secure Settings') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white bg-opacity-75 overflow-hidden shadow-sm sm:rounded-lg dark:bg-zinc-900 dark:bg-opacity-75 dark:text-gray-200 mx-auto max-w-7xl pt-4 lg:flex lg:gap-x-16 lg:px-8">
                <x-setting-navigation />

                <main class="px-4 pt-1 pb-6 sm:px-6 lg:flex-auto lg:px-0">
                    <div class="mx-auto max-w-2xl space-y-16 sm:space-y-20 lg:mx-0 lg:max-w-none">
                        <div>
                            <dl class="space-y-3 divide-y divide-gray-100 text-sm leading-6">
                                <div>
                                    <h2 class="font-semibold leading-7 text-lg pt-6 pb-4">
                                        {{ __('Text Censor Service') }}
                                    </h2>
                                    <dl class="space-y-3 divide-y divide-gray-100 text-sm leading-6">
                                        <div class="pt-6 sm:flex text-base">
                                            <dt class="font-medium sm:w-64 sm:flex-none sm:pr-6">{{ __('Comment Text Censor Check') }}</dt>
                                            <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                                <Switch text="{{ __('on|off') }}" :value="{{ $COMMENT_TEXT_CENSOR }}" input-key="COMMENT_TEXT_CENSOR" save-url="{{ route('dashboard.update') }}" />
                                            </dd>
                                        </div>
                                        @if($COMMENT_TEXT_CENSOR)
                                            <x-setting-input label="{{ __('Baidu App Id') }}" attribute="BAIDU_APP_ID" :value="$BAIDU_APP_ID" />
                                            <x-setting-input label="{{ __('Baidu Api Key') }}" attribute="BAIDU_API_KEY" :value="$BAIDU_API_KEY" type="password" />
                                            <x-setting-input label="{{ __('Baidu Secret Key') }}" attribute="BAIDU_SECRET_KEY" :value="$BAIDU_SECRET_KEY" type="password" />
                                        @endif
                                    </dl>
                                </div>
                                <div>
                                    <h2 class="font-semibold leading-7 text-lg pt-6 pb-4">
                                        {{ __('User Security Service') }}
                                    </h2>
                                    <dl class="space-y-3 divide-y divide-gray-100 text-sm leading-6">
                                        <div class="pt-3 sm:flex text-base">
                                            <dt class="font-medium sm:w-64 sm:flex-none sm:pr-6">{{ __('User Register Enable') }}</dt>
                                            <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                                <Switch text="{{ __('on|off') }}" :value="{{ $REGISTER_ENABLED }}" input-key="REGISTER_ENABLED" save-url="{{ route('dashboard.update') }}" />
                                            </dd>
                                        </div>
                                        <div class="pt-3 sm:flex text-base">
                                            <dt class="font-medium sm:w-64 sm:flex-none sm:pr-6">{{ __('User Email Verify Enable') }}</dt>
                                            <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                                <Switch text="{{ __('on|off') }}" :value="{{ $EMAIL_VERIFIED_ENABLED }}" input-key="EMAIL_VERIFIED_ENABLED" save-url="{{ route('dashboard.update') }}" />
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                            </dl>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>
