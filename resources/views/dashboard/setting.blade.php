<x-app-layout>
    @seoTitle(__('Site Settings'))
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Site Settings') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white bg-opacity-50 overflow-hidden shadow-sm sm:rounded-lg dark:bg-zinc-900 dark:bg-opacity-50 dark:text-gray-200 mx-auto max-w-7xl pt-4 lg:flex lg:gap-x-16 lg:px-8 backdrop-blur-sm backdrop-filter">
                <x-setting-navigation />

                <main class="px-4 pb-6 sm:px-6 lg:flex-auto lg:px-0">
                    <div class="mx-auto max-w-2xl space-y-16 sm:space-y-20 lg:mx-0 lg:max-w-none">
                        <div>
                            <dl class="space-y-3 divide-y divide-gray-100 text-sm leading-6">
                                <div class="pt-6 sm:flex text-base">
                                    <dt class="font-medium sm:w-64 sm:flex-none sm:pr-6">{{ __('Site Status') }}</dt>
                                    <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                        <Switch text="{{ __('on|off') }}" :value="{{ $APP_SWITCH }}" input-key="APP_SWITCH" save-url="{{ route('dashboard.update') }}" />
                                    </dd>
                                </div>
                                <x-setting-textarea label="{{ __('MAINTENANCE') }}" attribute="APP_SWITCH_MESSAGE" :value="$APP_SWITCH_MESSAGE" />
                                <x-setting-input label="{{ __('Site Name') }}" attribute="APP_NAME" :value="$APP_NAME" />
                                <x-setting-input label="{{ __('Site URL') }}" attribute="APP_URL" :value="$APP_URL" />
                                <div class="pt-3 sm:flex text-base">
                                    <dt class="font-medium sm:w-64 sm:flex-none sm:pr-6 leading-9">{{ __('Site Logo') }}</dt>
                                    <dd class="w-full">
                                        <UploadImage check-url="{{ route('upload.check_exists') }}" upload-url="{{ route('upload.image') }}" input-key="APP_LOGO" button-text="{{ __('Site Logo') }}" save-url="{{ route('dashboard.update') }}" image-url="{{ $APP_LOGO }}"/>
                                    </dd>
                                </div>
                                <x-setting-select label="{{ __('Site Timezone') }}" attribute="APP_TIMEZONE" :value="$APP_TIMEZONE" :options="$APP_TIMEZONES" />
                                <x-setting-select label="{{ __('Site Locale') }}" attribute="APP_LOCALE" :value="$APP_LOCALE" :options="$APP_LOCALES" />
                                <div class="pt-3 sm:flex text-base">
                                    <dt class="font-medium sm:w-64 sm:flex-none sm:pr-6 leading-9">{{ __('Site Font') }}</dt>
                                    <dd class="w-full">
                                        <FontSelect input-key="APP_FONT_FAMILY" value="{{ $APP_FONT_FAMILY }}" button-text="{{ __('Select Font') }}" save-url="{{ route('dashboard.update') }}" />
                                    </dd>
                                </div>
                                <x-setting-input label="{{ __('Site Keywords') }}" attribute="APP_KEYWORDS" :value="$APP_KEYWORDS" />
                                <x-setting-textarea label="{{ __('Site Description') }}" attribute="APP_DESCRIPTION" :value="$APP_DESCRIPTION" />
                                <x-setting-input label="{{ __('ICP License') }}" attribute="ICP_NUMBER" :value="$ICP_NUMBER" />
                            </dl>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>
