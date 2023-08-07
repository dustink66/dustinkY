<x-app-layout>
    @seoTitle(__('Background Image'))
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Background Image') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white bg-opacity-75 overflow-hidden shadow-sm sm:rounded-lg dark:bg-zinc-900 dark:bg-opacity-75 dark:text-gray-200 mx-auto max-w-7xl pt-4 lg:flex lg:gap-x-16 lg:px-8">
                <x-setting-navigation />

                <main class="px-4 pt-6 pb-10 sm:px-6 lg:flex-auto lg:px-0">
                    <div class="mx-auto max-w-2xl space-y-16 sm:space-y-20 lg:mx-0 lg:max-w-none">
                        <div>
                            <UploadMultipleImage check-url="{{ route('upload.check_exists') }}" upload-url="{{ route('upload.image') }}" input-key="BACKGROUND_IMAGE" button-text="{{ __('Click here to upload background image') }}" save-url="{{ route('dashboard.update') }}" image-list="{{ $BACKGROUND_IMAGE }}" class="py-4"/>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>
