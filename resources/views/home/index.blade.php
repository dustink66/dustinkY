<x-layout>
    <div class="z-0 py-24 max-w-7xl mx-auto px-4">
        @seoTitle(__('Home'))
        <HomeGlide slide-list="{{ $sliderPosts }}" />
        <div class="flex flex-col md:flex-row">
            <div class="w-full md:pr-3">
                <x-main-list :posts="$newestPublishedPosts" :webMaster="$webMaster"></x-main-list>
            </div>
            <div class="flex-shrink max-w-sm md:pl-3">
                <x-main-person :postsCount="$postsCount" :tagsCount="$tagsCount" :webMasterInfo="$webMaster" :viewCount="$totalUV"></x-main-person>
                <div class="bg-white bg-opacity-50 dark:bg-zinc-900 dark:bg-opacity-50 rounded-2xl py-4 px-4 my-6 hover:shadow-2xl dark:hover:shadow-2xl dark:hover:shadow-gray-400 backdrop-blur-sm backdrop-filter">
                    <Motto/>
                </div>
                <div class="bg-white bg-opacity-50 dark:bg-zinc-900 dark:bg-opacity-50 rounded-2xl my-6 hover:shadow-2xl dark:hover:shadow-2xl dark:hover:shadow-gray-400 backdrop-blur-sm backdrop-filter">
                    <HomeCalendar text="{{ __('View articles published this month') }}" />
                </div>
            </div>
        </div>
    </div>
</x-layout>
