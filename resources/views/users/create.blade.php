<x-app-layout>
    @seoTitle(__('Create User'))
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
                {{ __('Create User') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white bg-opacity-75 overflow-hidden shadow-sm sm:rounded-lg dark:bg-zinc-900 dark:bg-opacity-75 dark:text-gray-200 lg:px-8 lg:py-6">
                <x-splade-form :for="$form" />
            </div>
        </div>
    </div>
</x-app-layout>
