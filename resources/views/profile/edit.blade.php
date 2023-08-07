<x-app-layout>
    @seoTitle(__('Profile'))
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-zinc-900 bg-opacity-75 dark:bg-opacity-75">
                <div class="max-w-xl" dusk="update-profile-information">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-zinc-900 bg-opacity-75 dark:bg-opacity-75">
                <div class="max-w-xl" dusk="update-password">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            @if(auth()->user()->id !== 1)
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-zinc-900 bg-opacity-75 dark:bg-opacity-75">
                    <div class="max-w-xl" dusk="delete-user">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
