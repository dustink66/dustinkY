@props(['postsCount', 'tagsCount', 'webMasterInfo', 'viewCount'])
<div
    class="relative bg-white overflow-hidden bg-opacity-75 dark:bg-zinc-900 dark:bg-opacity-75 rounded-2xl my-6 hover:shadow-2xl dark:hover:shadow-2xl dark:hover:shadow-gray-400">
    <div class="flex items-center gap-x-4 text-sm {{ $FONT_FAMILY }} absolute right-0 top-0">
        <a href="mailto:{{$webMasterInfo->email}}" class="bg-green-50 py-4 px-4 rounded-bl-full hover:bg-green-400 text-green-700 hover:text-gray-100 dark:bg-green-50/10  dark:text-green-400" title="给我写信">
            <div class="antd icon-xiexin text-3xl -mt-3 -mr-2 transform hover:scale-125 transition duration-300"></div>
        </a>
    </div>
    <div class="mx-auto">
        <div class="flex justify-center items-center pb-4">
            <Avatar src="{{ $webMasterInfo->avatar }}" />
        </div>
        <div class="flex justify-center items-center"><span
                class="text-2xl {{ $FONT_FAMILY }} dark:text-gray-100">{{ $webMasterInfo->name }}</span></div>
        <div class="mx-auto p-4">
            <dl class="grid grid-cols-1 gap-0.5 overflow-hidden rounded-2xl text-center sm:grid-cols-2 lg:grid-cols-3 {{ $FONT_FAMILY }} border-2 border-gray-100">
                <div
                    class="flex flex-col bg-gray-300 bg-opacity-50 p-4 hover:bg-gray-100 dark:bg-zinc-800 dark:bg-opacity-75 dark:hover:bg-zinc-900">
                    <span class=" transform hover:scale-125 transition duration-300">
                        <dd class="order-first text-3xl tracking-tight text-gray-900 dark:text-gray-100">
                            {{ $postsCount }}
                        </dd>
                        <dt class="text-lg py-1 leading-6 text-gray-600 dark:text-gray-200">
                            <span class="antd icon-article-fill pr-1"></span>文章
                        </dt>
                    </span>
                </div>
                <div
                    class="flex flex-col bg-gray-300 bg-opacity-50 p-4 hover:bg-gray-100 dark:bg-zinc-800 dark:bg-opacity-75 dark:hover:bg-zinc-900">
                    <span class=" transform hover:scale-125 transition duration-300">
                        <dd class="order-first text-3xl tracking-tight text-gray-900 dark:text-gray-100">
                            {{ $tagsCount }}
                        </dd>
                        <dt class="text-lg py-1 leading-6 text-gray-600 dark:text-gray-200">
                            <span class="antd icon-tags-fill pr-1"></span>标签
                        </dt>
                    </span>
                </div>
                <div
                    class="flex flex-col bg-gray-300 bg-opacity-50 p-4 hover:bg-gray-100 dark:bg-zinc-800 dark:bg-opacity-75 dark:hover:bg-zinc-900">
                    <span class=" transform hover:scale-125 transition duration-300">
                        <dd class="order-first text-3xl tracking-tight text-gray-900 dark:text-gray-100">
                            {{ $viewCount }}
                        </dd>
                        <dt class="text-lg py-1 leading-6 text-gray-600 dark:text-gray-200">
                            <span class="antd icon-eye-fill pr-1"></span>访客
                        </dt>
                    </span>
                </div>
            </dl>
        </div>
    </div>
</div>
