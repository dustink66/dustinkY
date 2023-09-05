@if($BACKGROUND_TYPE == 'image')
    <div class="fixed top-0 left-0 w-full h-full z-[-100]">
        <div class="object-cover w-full h-full" style="background-image: url({{ $BACKGROUND_IMAGE }});background-size: cover;"></div>
        <div class="bg-gray-100 bg-opacity-25 absolute top-0 left-0 w-full h-full dark:bg-zinc-900 dark:bg-opacity-25"></div>
    </div>
@elseif($BACKGROUND_TYPE == 'video')
    <div class="fixed top-0 left-0 w-full h-full z-[-100]">
        <video autoplay muted loop class="object-cover w-full h-full" style="object-fit: cover;">
            <source src="{{ $BACKGROUND_IMAGE }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="bg-gray-100 bg-opacity-25 absolute top-0 left-0 w-full h-full dark:bg-zinc-900 dark:bg-opacity-25"></div>
    </div>
@endif
<div class="text-gray-900 antialiased {{ $FONT_FAMILY }}">
    {{ $slot }}
</div>
