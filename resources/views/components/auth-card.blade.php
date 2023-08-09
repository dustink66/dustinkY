<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
    <div>
        @isset($logo)
            {{ $logo }}
        @else
            <Link href="/">
                <SvgLogo height="h-20" url="{{ env('APP_LOGO') }}" font-size="text-5xl" site-name="{{ env('APP_NAME') }}" />
            </Link>
        @endisset
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white bg-opacity-80 shadow-md overflow-hidden sm:rounded-lg dark:bg-zinc-800 dark:bg-opacity-80">
        {{ $slot }}
    </div>
</div>
