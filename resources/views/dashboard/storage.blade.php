<x-app-layout>
    @seoTitle(__('Storage Settings'))
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Storage Settings') }}
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
                                <x-setting-select label="{{ __('Default Strorage') }}" attribute="FILESYSTEM_DISK" :value="$FILESYSTEM_DISK" :options="$FILESYSTEM_DISKS" />
                                @if($FILESYSTEM_DISK == 'qiniu')
                                <x-setting-input label="{{ __('Qiniu Access Key') }}" attribute="QINIU_ACCESS_KEY" :value="$QINIU_ACCESS_KEY" />
                                <x-setting-input label="{{ __('Qiniu Secret Key') }}" attribute="QINIU_SECRET_KEY" :value="$QINIU_SECRET_KEY" type="password" />
                                <x-setting-input label="{{ __('Qiniu Bucket') }}" attribute="QINIU_BUCKET" :value="$QINIU_BUCKET" />
                                <x-setting-input label="{{ __('Qiniu Domain') }}" attribute="QINIU_DOMAIN" :value="$QINIU_DOMAIN" />
                                @endif
                            </dl>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>
