<x-splade-component is="dropdown" {{ $attributes->class('w-full bg-white bg-opacity-80 dark:bg-zinc-900 dark:bg-opacity-80 border border-gray-300 rounded-md shadow-sm px-2.5 sm:px-4 py-2 inline-flex justify-center text-sm font-medium text-gray-700 hover:bg-gray-50 dark:hover:bg-zinc-500 focus:outline-none dark:focus:outline-none dark:focus:ring-offset-0 focus:ring-2 focus:ring-offset-2 focus:ring-green-500') }}>
    <x-slot:trigger>
        {{ $button }}
    </x-slot:trigger>

    <div class="mt-2 min-w-max rounded-md shadow-lg bg-white dark:bg-zinc-900 ring-1 ring-black ring-opacity-5">
        {{ $slot }}
    </div>
</x-splade-component>
