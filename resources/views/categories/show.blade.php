<x-layout>
    @seoTitle($category->title)
    <div class="py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-4">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="{{ $FONT_FAMILY }} text-3xl font-bold tracking-wider text-white sm:text-5xl" style="text-shadow: rgb(0, 0, 0) 0px 0px 0.8em, rgb(0, 0, 0) 0px 0px 0.4em;">{{ $category->title }}</h2>
            </div>
            <div>
                <div class="hidden sm:block mt-8">
                    <div class="">
                        <nav class="-mb-px flex space-x-8 items-center justify-center" aria-label="Tabs" style="text-shadow: rgb(0, 0, 0) 0px 0px 0.8em, rgb(0, 0, 0) 0px 0px 0.4em;">
                            <Link href="#" class="text-gray-100 hover:border-gray-200 hover:text-gray-300 flex whitespace-nowrap border-b-2 py-4 px-1 text-base font-medium">
                                All
                                <span class="bg-gray-100 text-gray-900 ml-3 hidden rounded-full py-1 px-2.5 text-xs font-medium md:inline-block">{{ $category->posts_count }}</span>
                            </Link>
                            @if($category->parent)
                                <Link href="{{ route('categories.show', $category->parent) }}" class="border-transparent text-gray-100 hover:border-gray-200 hover:text-gray-300 flex whitespace-nowrap border-b-2 py-4 px-1 text-base font-medium">
                                    <span class="transform hover:scale-110 transition duration-300">{{ $category->parent->title }}</span>
                                </Link>
                            @endif
                           @foreach($category->children as $child)
                                <Link href="{{ route('categories.show', $child) }}" class="border-transparent text-gray-100 hover:border-gray-200 hover:text-gray-300 flex whitespace-nowrap border-b-2 py-4 px-1 text-base font-medium">
                                    <span class="transform hover:scale-110 transition duration-300">{{ $child->title }}</span>
                                </Link>
                           @endforeach
                        </nav>
                    </div>
                </div>
            </div>

            @if($posts->isEmpty())
                    <div class="border border-gray-100 bg-white bg-opacity-75 dark:bg-zinc-900 dark:bg-opacity-75 rounded-2xl dark:border-gray-700 text-center pb-12 mt-16">
                        <x-empty tipsText="{{ __('The blogger is preparing high-quality content, please wait patiently...') }}" />
                    </div>
            @else
                <div class="mx-auto mt-16 grid max-w-2xl auto-rows-fr grid-cols-1 gap-8 sm:mt-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                    @foreach ($posts as $post)
                        <article class="relative isolate flex flex-col justify-end overflow-hidden rounded-2xl bg-gray-100 bg-opacity-80 dark:bg-zinc-700 dark:bg-opacity-80 px-8 pb-8 pt-80 sm:pt-48 lg:pt-80">
                            <img src="{{ $post->image }}" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover">
                            <div class="absolute inset-0 -z-10 bg-gradient-to-t from-gray-100 via-gray-100/40 dark:from-gray-900 dark:via-gray-900/40"></div>
                            <div class="absolute inset-0 -z-10 rounded-2xl ring-1 ring-inset ring-gray-100/10 dark:ring-gray-900/10"></div>

                            <div class="flex flex-wrap items-center gap-y-1 overflow-hidden text-sm leading-6 text-gray-600 dark:text-gray-300">
                                <time datetime="{{ $post->published_at }}" class="mr-8">{{ $post->published_at->format('Y'.'年'.'m'.'月'.'d'.'日'.' H:i') }}</time>
                            </div>
                            <h3 class="mt-3 text-lg font-semibold leading-6 text-black dark:text-white">
                                <Link href="{{ route('posts.show', $post) }}">
                                    <span class="absolute inset-0"></span>
                                    {{ $post->title }}
                                </Link>
                            </h3>
                        </article>
                    @endforeach
                    <!-- More posts... -->
                </div>
                <div class="mt-5">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layout>
