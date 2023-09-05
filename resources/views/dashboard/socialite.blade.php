<x-app-layout>
    @seoTitle(__('Socialite Settings'))
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Socialite Settings') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white bg-opacity-50 overflow-hidden shadow-sm sm:rounded-lg dark:bg-zinc-900 dark:bg-opacity-50 dark:text-gray-200 mx-auto max-w-7xl pt-4 lg:flex lg:gap-x-16 lg:px-8 backdrop-blur-sm backdrop-filter">
                <x-setting-navigation />

                <main class="px-4 pb-6 sm:px-6 lg:flex-auto lg:px-0">
                    <div class="mx-auto max-w-2xl space-y-8 sm:space-y-8 lg:mx-0 lg:max-w-none">
                        <div>
                            <dl class="space-y-3 divide-y divide-gray-100 text-sm leading-6">
                                <div class="pt-6 sm:flex text-base pb-4">
                                    <dt class="font-medium sm:w-64 sm:flex-none sm:pr-6">{{ __('Socialite Login Enable') }}</dt>
                                    <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                        <Switch text="{{ __('on|off') }}" :value="{{ $SOCIALITE_ENABLED }}" input-key="SOCIALITE_ENABLED" save-url="{{ route('dashboard.update') }}" />
                                    </dd>
                                </div>
                            </dl>
                        </div>
                        <div>
                            <h2 class="font-semibold leading-7 text-lg pb-4">
                                <span class="software dustink-qq text-xl"></span>
                                {{ __('QQ Settings') }}
                            </h2>
                            <dl class="space-y-3 divide-y divide-gray-100 text-sm leading-6">
                                <x-setting-input label="{{ __('QQ Client Id') }}" attribute="QQ_CLIENT_ID" :value="$QQ_CLIENT_ID" />
                                <x-setting-input label="{{ __('QQ Client Secret') }}" attribute="QQ_CLIENT_SECRET" :value="$QQ_CLIENT_SECRET" type="password" />
                            </dl>
                            <div class="flex mt-2 lg:mt-6 text-sm leading-6 text-gray-500 justify-end">{!! trans('setting.qq_info') !!}</div>
                        </div>
                        <div>
                            <h2 class="font-semibold leading-7 text-lg pb-4">
                                <span class="software dustink-weibo text-xl"></span>
                                {{ __('Weibo Settings') }}
                            </h2>
                            <dl class="space-y-3 divide-y divide-gray-100 text-sm leading-6">
                                <x-setting-input label="{{ __('Weibo Client Id') }}" attribute="WEIBO_CLIENT_ID" :value="$WEIBO_CLIENT_ID" />
                                <x-setting-input label="{{ __('Weibo Client Secret') }}" attribute="WEIBO_CLIENT_SECRET" :value="$WEIBO_CLIENT_SECRET" type="password" />
                            </dl>
                            <div class="flex mt-2 lg:mt-6 text-sm leading-6 text-gray-500 justify-end">{!! trans('setting.weibo_info') !!}</div>
                        </div>
                        <div>
                            <h2 class="font-semibold leading-7 text-lg pb-4">
                                <span class="software dustink-github text-xl"></span>
                                {{ __('Github Settings') }}
                            </h2>
                            <dl class="space-y-3 divide-y divide-gray-100 text-sm leading-6">
                                <x-setting-input label="{{ __('Github Client Id') }}" attribute="GITHUB_CLIENT_ID" :value="$GITHUB_CLIENT_ID" />
                                <x-setting-input label="{{ __('Github Client Secret') }}" attribute="GITHUB_CLIENT_SECRET" :value="$GITHUB_CLIENT_SECRET" type="password" />
                            </dl>
                            <div class="flex mt-2 lg:mt-6 text-sm leading-6 text-gray-500 justify-end">{!! trans('setting.github_info') !!}</div>
                        </div>
                        <div>
                            <h2 class="font-semibold leading-7 text-lg pb-4">
                                <span class="software dustink-gitee text-xl"></span>
                                {{ __('Gitee Settings') }}
                            </h2>
                            <dl class="space-y-3 divide-y divide-gray-100 text-sm leading-6">
                                <x-setting-input label="{{ __('Gitee Client Id') }}" attribute="GITEE_CLIENT_ID" :value="$GITEE_CLIENT_ID" />
                                <x-setting-input label="{{ __('Gitee Client Secret') }}" attribute="GITEE_CLIENT_SECRET" :value="$GITEE_CLIENT_SECRET" type="password" />
                            </dl>
                            <div class="flex mt-2 lg:mt-6 text-sm leading-6 text-gray-500 justify-end">{!! trans('setting.gitee_info') !!}</div>
                        </div>
                        <div>
                            <h2 class="font-semibold leading-7 text-lg pb-4">
                                <span class="software dustink-microsoft text-xl"></span>
                                {{ __('Outlook Settings') }}
                            </h2>
                            <dl class="space-y-3 divide-y divide-gray-100 text-sm leading-6">
                                <x-setting-input label="{{ __('Outlook Client Id') }}" attribute="OUTLOOK_CLIENT_ID" :value="$OUTLOOK_CLIENT_ID" />
                                <x-setting-input label="{{ __('Outlook Client Secret') }}" attribute="OUTLOOK_CLIENT_SECRET" :value="$OUTLOOK_CLIENT_SECRET" type="password" />
                            </dl>
                            <div class="flex mt-2 lg:mt-6 text-sm leading-6 text-gray-500 justify-end">{!! trans('setting.outlook_info') !!}</div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>
