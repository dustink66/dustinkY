@props(['width' => '48', 'type' => 'normal'])

@php
switch ($width) {
    case '24':
        $width = 'w-24';
        break;
    case '48':
        $width = 'w-48';
        break;
    case '56':
        $width = 'w-56';
        break;
}
switch ($type) {
    case 'nav':
        $nav = 'mt-3';
        break;
    case 'normal':
        $nav = 'mt-5';
        break;
}
@endphp

<x-splade-dropdown {{ $attributes->except('width') }}>
    <x-slot:trigger>
        {{ $trigger }}
    </x-slot:trigger>

    <div class="{{$nav}} {{$width}} rounded-md shadow-lg ring-1 ring-black ring-opacity-5 py-1 bg-white bg-opacity-75 dark:bg-zinc-800 dark:bg-opacity-75">
        {{ $content }}
    </div>
</x-splade-dropdown>
