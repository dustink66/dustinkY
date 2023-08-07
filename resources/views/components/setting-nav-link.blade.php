@props(['active', 'as' => 'Link'])

@php
    $classes = ($active ?? false)
                ? 'bg-gray-50 text-xl text-green-500 group flex gap-x-3 rounded-md py-2 pl-2 pr-3 leading-7 font-semibold'
                : 'text-gray-700 text-base hover:text-xl hover:font-semibold dark:text-gray-200 dark:hover:text-green-500 hover:text-green-500 hover:bg-gray-50 group flex gap-x-3 rounded-md py-2 pl-2 pr-3 leading-7';
@endphp

<{{ $as }} {{ $attributes->class($classes) }}>
{{ $slot }}
</{{ $as }}>
