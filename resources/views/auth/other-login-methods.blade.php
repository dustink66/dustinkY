<div class="relative">
    <div class="absolute inset-0 flex items-center" aria-hidden="true">
        <div class="w-full border-t border-gray-300"></div>
    </div>
    <div class="relative flex justify-center">
        <span class="bg-white px-2 text-sm text-gray-500 dark:bg-zinc-800 dark:text-gray-200">{{ __('Other login methods') }}</span>
    </div>
</div>

<div class="flex text-center justify-center">
    @if(Config::has('services.qq') && config('services.qq.client_id') && config('services.qq.client_secret'))
        <Link href="{{ route('oauth.redirect', 'qq') }}">
            <span class="block px-1 text-blue-400 hover:text-blue-300 dark:text-gray-200 antd icon-qq-login text-4xl"></span>
        </Link>
    @endif
    @if(Config::has('services.github') && config('services.github.client_id') && config('services.github.client_secret'))
        <Link href="{{ route('oauth.redirect', 'github') }}">
            <span class="block px-1 text-gray-900 hover:text-gray-500 dark:text-gray-200 antd icon-github-login-copy text-4xl"></span>
        </Link>
    @endif
    @if(Config::has('services.gitee') && config('services.gitee.client_id') && config('services.gitee.client_secret'))
        <Link href="{{ route('oauth.redirect', 'gitee') }}">
            <span class="block px-1 text-red-600 hover:text-red-400 dark:text-gray-200 antd icon-gitee text-4xl"></span>
        </Link>
    @endif
    @if(Config::has('services.outlook') && config('services.outlook.client_id') && config('services.outlook.client_secret'))
        <Link href="{{ route('oauth.redirect', 'outlook') }}">
            <span class="block px-1 text-blue-500 hover:text-blue-400 dark:text-gray-200 antd icon-windows-circle-fill text-4xl"></span>
        </Link>
    @endif
    @if(Config::has('services.weibo') && config('services.weibo.client_id') && config('services.weibo.client_secret'))
        <Link href="{{ route('oauth.redirect', 'weibo') }}">
            <span class="block px-1 text-red-500 hover:text-red-400 dark:text-gray-200 antd icon-weibo-circle-fill text-4xl"></span>
        </Link>
    @endif
</div>
