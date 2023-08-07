@props(['as' => 'Link'])

<{{ $as }} {{ $attributes->class('block px-4 py-2 text-sm leading-5 text-gray-700 bg-opacity-75 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out  dark:text-gray-200 dark:hover:bg-gray-100 dark:hover:text-gray-900 dark:bg-opacity-75') }}><span class="{{ $FONT_FAMILY }}">{{ $slot }}</span></{{ $as }}>
