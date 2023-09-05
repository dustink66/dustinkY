<x-app-layout>
    @seoTitle(__('Background Video'))
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Background Video') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white bg-opacity-50 overflow-hidden shadow-sm sm:rounded-lg dark:bg-zinc-900 dark:bg-opacity-50 dark:text-gray-200 mx-auto max-w-7xl pt-4 lg:flex lg:gap-x-16 lg:px-8 backdrop-blur-sm backdrop-filter">
                <x-setting-navigation />

                <main class="px-4 pt-6 pb-10 sm:px-6 lg:flex-auto lg:px-0">
                    <div class="mx-auto max-w-2xl space-y-16 sm:space-y-20 lg:mx-0 lg:max-w-none">
                        <div>
                            <UploadVideo check-url="{{ route('upload.check_exists') }}" upload-url="{{ route('upload.video') }}" input-key="BACKGROUND_VIDEO" button-text="{{ __('Click here to upload background video') }}" save-url="{{ route('dashboard.update') }}" video-list="{{ $BACKGROUND_VIDEO }}" class="py-4"/>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>
