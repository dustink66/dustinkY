@props(['keyword' => 1])
<div class="flex h-screen min-h-full flex-col justify-center items-center">
    <main class="flex w-full flex-col flex-grow place-content-center">
        <div class="flex -mt-52 mb-5 justify-center ">
            @isset($logo)
                {{ $logo }}
            @else
                <Link href="/">
                    <SvgLogo height="h-16" />
                </Link>
            @endisset
        </div>
        {{ $slot }}
    </main>
</div>
