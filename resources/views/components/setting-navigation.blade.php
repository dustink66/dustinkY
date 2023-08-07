<x-splade-toggle>
    <aside class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0">
        <nav class="flex-none px-4 sm:px-6 lg:px-0">
            <ul role="list" class="flex gap-x-3 gap-y-2 whitespace-nowrap lg:flex-col">
                <li>
                    <x-setting-nav-link :href="route('dashboard.setting')" :active="request()->routeIs('dashboard.setting')">
                                    <span class="antd icon-site text-xl shrink-0">
                                    </span>
                        {{ __('Site Settings') }}
                    </x-setting-nav-link>
                </li>
                <li>
                    <x-setting-nav-link :href="route('dashboard.storage')" :active="request()->routeIs('dashboard.storage')">
                                    <span class="antd icon-storage text-xl shrink-0">
                                    </span>
                        {{ __('Storage Settings') }}
                    </x-setting-nav-link>
                </li>
                <li>
                    <x-setting-nav-link :href="route('dashboard.socialite')" :active="request()->routeIs('dashboard.socialite')">
                                    <span class="antd icon-socialfill text-xl shrink-0">
                                    </span>
                        {{ __('Socialite Settings') }}
                    </x-setting-nav-link>
                </li>
                <li>
                    <x-setting-nav-link :href="route('dashboard.master')" :active="request()->routeIs('dashboard.master')">
                                    <span class="antd icon-master text-xl shrink-0">
                                    </span>
                        {{ __('Webmaster Info') }}
                    </x-setting-nav-link>
                </li>
                <li>
                    <x-setting-nav-link :href="route('dashboard.mail')" :active="request()->routeIs('dashboard.mail')">
                                    <span class="antd icon-mail-setting text-xl shrink-0">
                                    </span>
                        {{ __('Mail Settings') }}
                    </x-setting-nav-link>
                </li>
                <li>
                    <x-setting-nav-link :href="route('dashboard.secure')" :active="request()->routeIs('dashboard.secure')">
                                    <span class="antd icon-secure text-xl shrink-0">
                                    </span>
                        {{ __('Secure Settings') }}
                    </x-setting-nav-link>
                </li>
                <li>
                    <x-setting-nav-link :href="route('dashboard.scout')" :active="request()->routeIs('dashboard.scout')">
                                    <span class="antd icon-search-f text-xl shrink-0">
                                    </span>
                        {{ __('Scout Settings') }}
                    </x-setting-nav-link>
                </li>
                <li>
                    <x-setting-nav-link :href="route('dashboard.background.image')" :active="request()->routeIs('dashboard.background.image')">
                                    <span class="antd icon-image-fill text-xl shrink-0">
                                    </span>
                        {{ __('Background Image') }}
                    </x-setting-nav-link>
                </li>
                <li>
                    <x-setting-nav-link :href="route('dashboard.background.video')" :active="request()->routeIs('dashboard.background.video')">
                                    <span class="antd icon-video-fill text-xl shrink-0">
                                    </span>
                        {{ __('Background Video') }}
                    </x-setting-nav-link>
                </li>
            </ul>
        </nav>
    </aside>
</x-splade-toggle>
