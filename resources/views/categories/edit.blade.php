<x-app-layout>
    @seoTitle(__('Edit Category'))
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
                {{ __('Edit Category') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4">
            <div class="px-6 py-6 bg-opacity-50 text-gray-800 shadow-sm rounded-lg sm:rounded-lg bg-white dark:bg-zinc-800 dark:bg-opacity-50 backdrop-blur-sm backdrop-filter">
                <x-splade-form :method="'patch'" action="{{ route('categories.update', $category) }}"  :default="$category" class="space-y-4">
                    <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Category Name') }}</span>
                    <x-splade-input id="title" type="text" name="title" placeholder="{{ __('Please enter category name') }}" required autofocus />
                    <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Category Slug') }}</span>
                    <x-splade-input id="slug" type="text" name="slug"  placeholder="{{ __('Please enter category slug') }}" required autocomplete="current-password" />
                    <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Category Description') }}</span>
                    <x-splade-textarea id="description" name="description" placeholder="{{ __('Please enter category description') }}" required />
                    <span class="block mb-1 text-gray-700 dark:text-gray-200">{{ __('Category Parent') }}</span>
                    <x-splade-select id="parent_id" name="parent_id" :options="$categories" option-label="title" option-value="id" />
                    <div class="w-full">
                        <x-splade-submit class="w-full" label="{{ __('Save Category') }}" />
                    </div>
                </x-splade-form>
            </div>
        </div>
    </div>

</x-app-layout>
