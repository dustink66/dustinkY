@props(['posts', 'webMaster'])

@foreach($posts as $key => $item)
    @if($key % 2 == 0) <!-- 判断当前索引是否为偶数 -->
    <div class="bg-white bg-opacity-50 dark:bg-zinc-900 dark:bg-opacity-50 rounded-2xl my-6 py-4 hover:shadow-2xl dark:hover:shadow-2xl dark:hover:shadow-gray-400 transform hover:scale-105 transition duration-300 backdrop-blur-sm backdrop-filter">
        <article class="relative isolate flex flex-col gap-4 lg:flex-row mx-auto px-4">
            @if($item->image)
                <div class="flex-shrink relative aspect-[16/9] sm:aspect-[2/1] lg:aspect-square lg:w-72 lg:h-60 lg:shrink-0 justify-end">
                    <img src="{{ $item->image }}" alt="" class="absolute inset-0 h-full w-full rounded-2xl bg-gray-300 bg-opacity-50 dark:bg-zinc-700 dark:bg-opacity-50 object-cover">
                    <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                </div>
            @endif
            <div class="flex-grow">
                <div class="flex items-center gap-x-4 text-sm {{ $FONT_FAMILY }} absolute right-0 top-0">
                    <span class="{{ $FONT_FAMILY }} bg-green-50 py-2 px-2 rounded-bl-2xl rounded-tr-2xl text-green-700 dark:ring-1 dark:ring-inset dark:ring-green-500/50 dark:bg-green-50/10 dark:text-green-400 -mt-4">{{ $item->category->title }}</span>
                </div>
                <div class="group relative pt-6">
                    <h3 class="text-2xl font-semibold tracking-wider leading-6 text-gray-900 dark:text-gray-100 group-hover:text-gray-600 dark:group-hover:text-gray-300 {{ $FONT_FAMILY }} line-clamp-1">
                        <Link href="{{ route('posts.show', $item) }}">
                            <span class="absolute inset-0"></span>
                            {{ $item->title }}
                        </Link>
                    </h3>
                    <p class="mt-5 @if($item->image) lg:h-14 @endif text-base leading-6 text-gray-700 tracking-wider {{ $FONT_FAMILY }} dark:text-gray-300 line-clamp-2 bg-gray-300 bg-opacity-50 dark:bg-zinc-700 dark:bg-opacity-50 rounded-lg px-2 py-1">{{ $item->meta_description }}</p>
                </div>
                <div class="mt-5 flex border-t border-gray-900/5 dark:border-gray-100/5 pt-5 {{ $FONT_FAMILY }} justify-end">
                    <div class="flex-grow text-left hidden sm:block">
                        @foreach($item->tags as $tag)
                            <Link href="{{ route('tag', $tag['name']) }}" class="inline-flex items-center rounded-md bg-green-50 m-1 px-2 py-1 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-green-50/10 dark:ring-green-500/20 dark:text-green-400 hover:bg-green-600/20">{{ $tag['name'] }}</Link>
                        @endforeach
                    </div>
                    <div class="relative text-right flex flex-shrink items-center gap-x-4 lg:shrink-0 pr-4">
                        <div class="text-sm leading-6">
                            <p class="text-gray-900 dark:text-gray-200 text-base">
                                <a href="#">
                                    <span class="absolute inset-0"></span>
                                    {{ $webMaster->name }}
                                </a>
                            </p>
                            <p class="text-gray-600 dark:text-gray-300">{{ $item->published_at }}</p>
                        </div>
                        <img src="{{ $webMaster->avatar }}" alt="" class="h-10 w-10 rounded-full bg-gray-400">
                    </div>
                </div>
            </div>
        </article>
    </div>
    @else
        <div class="bg-white bg-opacity-50 dark:bg-zinc-900 dark:bg-opacity-50 rounded-2xl my-6 py-4 hover:shadow-2xl dark:hover:shadow-2xl dark:hover:shadow-gray-400 transform hover:scale-105 transition duration-300 backdrop-blur-sm backdrop-filter">
            <article class="relative isolate flex flex-col gap-4 lg:flex-row mx-auto px-4">
                <div class="flex-grow">
                    <div class="flex items-center gap-x-4 text-sm {{ $FONT_FAMILY }} absolute left-0 top-0">
                        <span class="{{ $FONT_FAMILY }} bg-green-50 py-2 px-2 rounded-br-2xl rounded-tl-2xl text-green-700 dark:ring-1 dark:ring-inset dark:ring-green-500/50 dark:bg-green-50/10 dark:text-green-400 -mt-4">{{ $item->category->title }}</span>
                    </div>
                    <div class="group relative pt-6">
                        <h3 class="mt-3 text-2xl font-semibold tracking-wider leading-6 text-gray-900 dark:text-gray-100 group-hover:text-gray-600 dark:group-hover:text-gray-300 {{ $FONT_FAMILY }} line-clamp-1">
                            <Link href="{{ route('posts.show', $item) }}">
                                <span class="absolute inset-0"></span>
                                {{ $item->title }}
                            </Link>
                        </h3>
                        <p class="mt-5 @if($item->image && mb_strlen($item->meta_description, 'utf-8') < 55) lg:h-14 @endif text-base leading-6 text-gray-700 tracking-wider {{ $FONT_FAMILY }} dark:text-gray-300 line-clamp-2 bg-gray-300 bg-opacity-50 dark:bg-zinc-700 dark:bg-opacity-75 rounded-lg px-2 py-1">{{ $item->meta_description }}</p>
                    </div>
                    <div class="mt-4 flex border-t border-gray-900/5 dark:border-gray-100/5 pt-4 {{ $FONT_FAMILY }}">
                        <div class="relative flex flex-shrink items-center gap-x-4 lg:shrink-0 pr-4">
                            <img src="{{ $webMaster->avatar }}" alt="" class="h-10 w-10 rounded-full bg-gray-400">
                            <div class="text-sm leading-6">
                                <p class="text-gray-900 dark:text-gray-200 text-base">
                                    <a href="#">
                                        <span class="absolute inset-0"></span>
                                        {{ $webMaster->name }}
                                    </a>
                                </p>
                                <p class="text-gray-600 dark:text-gray-300">{{ $item->published_at }}</p>
                            </div>
                        </div>
                        <div class="flex-grow text-right hidden sm:block">
                            @foreach($item->tags as $tag)
                                <Link href="{{ route('tag', $tag['name']) }}" class="inline-flex items-center rounded-md bg-green-50 m-1 px-2 py-1 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-green-50/10 dark:ring-green-500/20 dark:text-green-400">{{ $tag['name'] }}</Link>
                            @endforeach
                        </div>
                    </div>
                </div>
                @if($item->image)
                    <div class="flex-shrink relative aspect-[16/9] sm:aspect-[2/1] lg:aspect-square lg:w-72 lg:h-60 lg:shrink-0 justify-end">
                        <img src="{{ $item->image }}" alt="" class="absolute inset-0 h-full w-full rounded-2xl bg-gray-300 bg-opacity-50 dark:bg-zinc-700 dark:bg-opacity-50 object-cover">
                        <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>
                    </div>
                @endif
            </article>
        </div>
    @endif
@endforeach
