@props(['active', 'as' => 'Link'])

@php
$classes = ($active ?? false)
            ? 'block pl-2 pr-2 py-2 border-l-4 border-green-500 text-base font-medium text-green-500 bg-green-50 focus:outline-none focus:text-green-800 focus:bg-green-100 focus:border-green-700 transition duration-150 ease-in-out dark:bg-zinc-700'
            : 'block pl-2 pr-2 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-green-700 hover:bg-green-400/25 hover:border-green-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out dark:text-gray-200 dark:hover:bg-green-50/10 dark:hover:text-green-400';
@endphp

<{{ $as }} {{ $attributes->class($classes) }}>
    {{ $slot }}
</{{ $as }}>
