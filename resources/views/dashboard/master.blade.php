<x-app-layout>
    @seoTitle(__('Webmaster Info'))
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Webmaster Info') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white bg-opacity-75 overflow-hidden shadow-sm sm:rounded-lg dark:bg-zinc-900 dark:bg-opacity-75 dark:text-gray-200 mx-auto max-w-7xl pt-4 lg:flex lg:gap-x-16 lg:px-8">
                <x-setting-navigation />

                <main class="px-4 pb-6 sm:px-6 lg:flex-auto lg:px-0">
                    <div class="mx-auto max-w-2xl space-y-16 sm:space-y-20 lg:mx-0 lg:max-w-none">
                        <div>
                            <dl class="space-y-3 divide-y divide-gray-100 text-sm leading-6">
                                <x-setting-input label="{{ __('Webmaster Name') }}" attribute="WEBMASTER_NAME" :value="$WEBMASTER_NAME" />
                                <x-setting-input label="{{ __('Webmaster Email') }}" attribute="WEBMASTER_EMAIL" :value="$WEBMASTER_EMAIL" />
                                <div class="pt-3 sm:flex">
                                    <dt class="font-medium sm:w-64 sm:flex-none sm:pr-6">{{ __('Webmaster Avatar') }}</dt>
                                    <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                                        <UploadAvatar check-url="{{ route('upload.check_exists') }}" upload-url="{{ route('upload.image') }}" input-key="WEBMASTER_AVATAR" button-text="{{ __('Upload avatar') }}" save-url="{{ route('dashboard.update') }}" avatar="{{ $WEBMASTER_AVATAR }}" class="py-4"/>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>
