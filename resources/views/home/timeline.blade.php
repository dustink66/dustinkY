<x-layout>
    @seoTitle(__('Timeline'))
    <div class="z-0 py-24 max-w-7xl mx-auto px-4">
        <h2 class=" text-center p-10 text-3xl font-bold tracking-wider text-white sm:text-5xl" style="text-shadow: rgb(0, 0, 0) 0 0 0.8em, rgb(0, 0, 0) 0 0 0.4em;">{{ __('Timeline') }}</h2>
        @forelse ($archive as $monthYear => $posts)
        <div class="p-5 mb-4 border border-gray-100 bg-white bg-opacity-50 dark:bg-zinc-900 dark:bg-opacity-50 rounded-2xl dark:border-gray-700 backdrop-blur-sm backdrop-filter">
            <time class="text-xl font-semibold text-gray-900 dark:text-white">{{ $monthYear }}</time>
            <ol class="relative border-l border-gray-500 dark:border-gray-300 mt-2">
                @foreach ($posts as $post)
                    <li class="mb-10 last:mb-0 ml-4">
                        <div class="absolute w-3 h-3 bg-gray-300 rounded-full mt-1.5 -left-1.5 border border-gray-500 dark:border-gray-300 dark:bg-zinc-500"></div>
                        <Link href="{{ route('posts.show', $post) }}">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $post->title }}</h3>
                                <time class="mb-1 text-sm font-normal text-gray-400 sm:order-last sm:mb-0">{{ $post->published_at }}</time>
                            </div>
                            <p class="text-base font-normal text-gray-500 dark:text-gray-400">{{ $post->meta_description }}</p>
                        </Link>
                    </li>
                @endforeach
            </ol>
        </div>
        @empty
            <div class="border border-gray-100 bg-white bg-opacity-50 dark:bg-zinc-900 dark:bg-opacity-50 rounded-2xl dark:border-gray-700 text-center pb-12 backdrop-blur-sm backdrop-filter">
                <x-empty tipsText="{{$emptyText}}" />
            </div>
        @endforelse
    </div>
</x-layout>
