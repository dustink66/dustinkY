<x-app-layout>
    @seoTitle(__('Dashboard'))
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            <div
                class="bg-white bg-opacity-75 overflow-hidden shadow-sm sm:rounded-lg dark:bg-zinc-900 dark:bg-opacity-75">
                <main>
                    <x-dashboard-overview :overview="$overview" />

                    <x-dashboard-system-info :operating_environment="$operating_environment" :dustinkY="$dustinkY" :site_info="$site_info" />


                </main>
            </div>
        </div>
    </div>
</x-app-layout>
