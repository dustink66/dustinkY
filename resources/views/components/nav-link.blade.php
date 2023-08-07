@props(['active', 'as' => 'Link'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center pt-1 text-sm font-medium leading-5 text-green-500 focus:outline-none focus:border-green-700 transition duration-300 ease-in-out dark:text-gray-100 dark:border-green-100'
            : 'inline-flex items-center pt-1 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:text-gray-700 transition duration-300 ease-in-out dark:text-gray-200 dark:hover:text-gray-100';
@endphp

<{{ $as }} {{ $attributes->class($classes) }}>
    <span class="hover:bg-green-400/25 rounded p-2 transform transition duration-300 hover:text-green-700 dark:hover:bg-green-50/10 dark:hover:text-green-400">{{ $slot }}</span>
</{{ $as }}>
