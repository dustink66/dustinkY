<x-app-layout>
    @seoTitle(__('Category'))
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
                {{ __('Category') }}
            </h2>
            <Link href="{{ route('categories.create') }}" type="button" class="inline-flex items-center rounded-md bg-green-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-400">
                <span class="antd icon-plus"></span>
                <span class="pl-1">{{ __('Create Category') }}</span>
            </Link>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4">
            <div class="px-6 py-1 bg-opacity-50 text-gray-600 shadow-sm rounded-lg sm:rounded-lg bg-white dark:bg-zinc-800 dark:bg-opacity-50 dark:text-gray-200 backdrop-blur-sm backdrop-filter">
                <x-category-list :categories="$categories"></x-category-list>
            </div>
        </div>
    </div>

</x-app-layout>
