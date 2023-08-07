@props(['overview'])
<div class="relative isolate overflow-hidden">
    <!-- Secondary navigation -->
    <header class="pb-4 pt-6 sm:pb-6">
        <div class="mx-auto flex max-w-7xl flex-wrap items-center gap-6 px-4 sm:flex-nowrap sm:px-6 lg:px-8">
            <h1 class="text-lg font-semibold leading-7 text-gray-900 dark:text-gray-200 dark:text-gray-200">{{ __('Data overview') }}</h1>
            <Link href="{{ route('posts.create') }}" class="ml-auto flex items-center gap-x-1 rounded-md bg-green-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-500">
                <span class="antd icon-plus"></span>
                {{ __('Create Post') }}
            </Link>
        </div>
    </header>

    <!-- Stats -->
    <div class="border-b border-b-gray-900/10 dark:border-b-gray-300/10 lg:border-t lg:border-t-gray-900/5 dark:lg:border-t-gray-300/5">
        <dl class="mx-auto grid max-w-7xl grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 lg:px-2 xl:px-0">
            <div class="flex items-baseline flex-wrap justify-between gap-y-2 gap-x-4 border-t border-gray-900/5 dark:border-gray-300/5 px-4 py-10 sm:px-6 lg:border-t-0 xl:px-8">
                <dt class="text-sm font-medium leading-6 text-gray-700 dark:text-gray-300">{{ __('Post Count') }}</dt>
                <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900 dark:text-gray-200">{{ $overview['postCount'] }}</dd>
            </div>
            <div class="flex items-baseline flex-wrap justify-between gap-y-2 gap-x-4 border-t border-gray-900/5 px-4 py-10 sm:px-6 lg:border-t-0 xl:px-8 sm:border-l">
                <dt class="text-sm font-medium leading-6 text-gray-700 dark:text-gray-300">{{ __('User Count') }}</dt>
                <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900 dark:text-gray-200">{{ $overview['userCount'] }}</dd>
            </div>
            <div class="flex items-baseline flex-wrap justify-between gap-y-2 gap-x-4 border-t border-gray-900/5 px-4 py-10 sm:px-6 lg:border-t-0 xl:px-8 lg:border-l">
                <dt class="text-sm font-medium leading-6 text-gray-700 dark:text-gray-300">{{ __('Category Count') }}</dt>
                <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900 dark:text-gray-200">{{ $overview['categoryCount'] }}</dd>
            </div>
            <div class="flex items-baseline flex-wrap justify-between gap-y-2 gap-x-4 border-t border-gray-900/5 px-4 py-10 sm:px-6 lg:border-t-0 xl:px-8 sm:border-l">
                <dt class="text-sm font-medium leading-6 text-gray-700 dark:text-gray-300">{{ __('Comment Count') }}</dt>
                <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900 dark:text-gray-200">{{ $overview['commentCount'] }}</dd>
            </div>
            <div class="flex items-baseline flex-wrap justify-between gap-y-2 gap-x-4 border-t border-gray-900/5 px-4 py-10 sm:px-6 lg:border-t-0 xl:px-8 sm:border-l">
                <dt class="text-sm font-medium leading-6 text-gray-700 dark:text-gray-300">{{ __('Tag Count') }}</dt>
                <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900 dark:text-gray-200">{{ $overview['tagCount'] }}</dd>
            </div>
        </dl>
    </div>

    <div class="absolute left-0 top-full -z-10 mt-96 origin-top-left translate-y-40 -rotate-90 transform-gpu opacity-20 blur-3xl sm:left-1/2 sm:-ml-96 sm:-mt-10 sm:translate-y-0 sm:rotate-0 sm:transform-gpu sm:opacity-50" aria-hidden="true">
        <div class="aspect-[1154/678] w-[72.125rem] bg-gradient-to-br from-[#FF80B5] to-[#9089FC]" style="clip-path: polygon(100% 38.5%, 82.6% 100%, 60.2% 37.7%, 52.4% 32.1%, 47.5% 41.8%, 45.2% 65.6%, 27.5% 23.4%, 0.1% 35.3%, 17.9% 0%, 27.7% 23.4%, 76.2% 2.5%, 74.2% 56%, 100% 38.5%)"></div>
    </div>
</div>
