@if($BACKGROUND_TYPE == 'image')
    <div class="fixed top-0 left-0 w-full h-full z-[-100]">
        <div class="object-cover w-full h-full" style="background-image: url({{ $BACKGROUND_IMAGE }});background-size: cover;"></div>
        <div class="bg-gray-100 bg-opacity-50 absolute top-0 left-0 w-full h-full dark:bg-zinc-900 dark:bg-opacity-50"></div>
    </div>
@elseif($BACKGROUND_TYPE == 'video')
    <div class="fixed top-0 left-0 w-full h-full z-[-100]">
        <video autoplay muted loop class="object-cover w-full h-full" style="object-fit: cover;">
            <source src="{{ $BACKGROUND_IMAGE }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="bg-gray-100 bg-opacity-50 absolute top-0 left-0 w-full h-full dark:bg-zinc-900 dark:bg-opacity-50"></div>
    </div>
@endif
<div class="flex flex-col flex-grow z-0 mx-auto {{ $FONT_FAMILY }}">

    @if(auth()->user()->id == 1)
        @include('layouts.navigation')
        <main class="flex-1 overflow-y-auto mt-36">
            {{ $slot }}
        </main>
    @else
        @include('components.navigation')
        <main class="flex-1 overflow-y-auto mt-12">
            {{ $slot }}
        </main>
    @endif
    <Footer app-name="{{ env('APP_NAME') }}" icp-number="{{ env('ICP_NUMBER') }}" />
</div>


