<x-app-layout>
    @seoTitle(__('Scout Settings'))
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Scout Settings') }}
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
                                <div class="pt-6 sm:flex text-base">
                                    <dt class="font-medium sm:w-64 sm:flex-none sm:pr-6">{{ __('Scout Enable') }}</dt>
                                    <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                        <Switch text="{{ __('on|off') }}" :value="{{ $SCOUT_ENABLED }}" input-key="SCOUT_ENABLED" save-url="{{ route('dashboard.update') }}" />
                                    </dd>
                                </div>
                                <x-setting-select label="{{ __('Scout Driver') }}" attribute="SCOUT_DRIVER" :value="$SCOUT_DRIVER" :options="$SCOUT_DRIVERS" />
                                @if($SCOUT_DRIVER == 'algolia')
                                    <x-setting-input label="{{ __('Algolia App Id') }}" attribute="ALGOLIA_APP_ID" :value="$ALGOLIA_APP_ID" />
                                    <x-setting-input label="{{ __('Algolia Secret') }}" attribute="ALGOLIA_SECRET" :value="$ALGOLIA_SECRET" type="password" />
                                @elseif($SCOUT_DRIVER == 'meilisearch')
                                    <x-setting-input label="{{ __('Meilisearch Host') }}" attribute="MEILISEARCH_HOST" :value="$MEILISEARCH_HOST" />
                                    <x-setting-input label="{{ __('Meilisearch Key') }}" attribute="MEILISEARCH_KEY" :value="$MEILISEARCH_KEY" type="password" />
                                @endif
                            </dl>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>
