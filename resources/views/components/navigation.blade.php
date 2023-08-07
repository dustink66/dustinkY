<x-splade-toggle>
    <nav id="navigation" class="bg-white bg-opacity-75 fixed top-0 w-full border-b border-gray-100 dark:bg-zinc-900 dark:border-zinc-700 dark:bg-opacity-75 z-40">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center transform hover:scale-125 transition duration-300">
                        <Link href="{{ route('home') }}">
                            <SvgLogo />
                        </Link>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                            <span class="antd icon-home-fill"><span class="ml-2 {{ $FONT_FAMILY }}">{{ __('Home') }}</span></span>
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-2 sm:flex">
                        <div class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:text-gray-700 transition duration-300 ease-in-out dark:text-gray-200 dark:hover:text-gray-100">
                            <x-dropdown width="48" type="nav">
                                <x-slot name="trigger">
                                    <div class="hover:bg-green-400/25 @if(request()->is('categories/*')) text-green-500 @else @endif rounded p-2 transform transition duration-300 hover:text-green-700 dark:hover:bg-green-50/10 dark:hover:text-green-400">
                                        <span class="antd icon-folder-fill">
                                            <span class="ml-2 {{ $FONT_FAMILY }}">{{ __('Category') }}</span>
                                        </span>
                                    </div>
                                </x-slot>

                                <x-slot name="content">
                                    @foreach(App\Services\CategoryManager::getTopCategories() as $category)
                                    <x-responsive-nav-link :href="route('categories.show', $category)" :active="request()->is('categories/'.$category->slug)">
                                        <span class="{{ $FONT_FAMILY }}">{{ $category->title }}</span>
                                    </x-responsive-nav-link>
                                    @endforeach
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-2 sm:flex">
                        <x-nav-link :href="route('tag')" :active="request()->routeIs('tag')">
                            <span class="antd icon-tags-fill"><span class="ml-2 {{ $FONT_FAMILY }}">{{ __('Tags') }}</span></span>
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-2 sm:flex">
                        <x-nav-link :href="route('timeline')" :active="request()->routeIs('timeline')">
                            <span class="antd icon-time-circle-fill"><span class="ml-2 {{ $FONT_FAMILY }}">{{ __('Timeline') }}</span></span>
                        </x-nav-link>
                    </div>

                </div>
                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    @if(env('SCOUT_ENABLED'))
                        <div class="hidden space-x-8 sm:-my-px sm:mr-5 sm:flex">
                            <div class="inline-flex items-center px-1 py-1 text-sm font-medium leading-5 text-gray-900">
                                <Search />
                            </div>
                        </div>
                    @endif
                    @auth
                    <x-dropdown width="24" placement="bottom-end">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-900 hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out dark:text-gray-200 dark:hover:text-gray-400">
                                <div class="{{ $FONT_FAMILY }} text-base">{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @if(Auth::user()->id == 1)
                                <x-dropdown-link :href="route('dashboard.index')">
                                    {{ __('Dashboard') }}
                                </x-dropdown-link>

                            @endif

                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link as="a" :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                    @else
                        <Link href="{{ route('login') }}" class="{{ $FONT_FAMILY }} text-gray-900 dark:text-gray-200 dark:hover:text-gray-100">{{ __('Log in') }}</Link>

                        @if (Route::has('register'))
                            <Link href="{{ route('register') }}" class="{{ $FONT_FAMILY }} ml-4 text-gray-900 dark:text-gray-200 dark:hover:text-gray-100">{{ __('Register') }}</Link>
                        @endif
                    @endauth
                        <ThemeSwitch class="ml-5 pt-1" />
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <ThemeSwitch class="mr-2 pt-1" />
                    <button @click="toggle" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path v-bind:class="{ hidden: toggled, 'inline-flex': !toggled }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path v-bind:class="{ hidden: !toggled, 'inline-flex': toggled }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div v-bind:class="{ block: toggled, hidden: !toggled }" class="sm:hidden">
            <div class="pt-2 pb-3 space-y-1 {{ $FONT_FAMILY }}">
                <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    {{ __('Home') }}
                </x-responsive-nav-link>
                <div class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out dark:text-gray-200 dark:hover:text-gray-100 dark:hover:border-gray-100">
                    {{ __('Category') }}
                    <div class="mt-3 space-y-1">
                        @foreach(App\Services\CategoryManager::getTopCategories() as $category)
                            <x-responsive-nav-link :href="route('categories.show', $category)" :active="request()->is('categories/'.$category->slug)">
                                <span class="{{ $FONT_FAMILY }}">{{ $category->title }}</span>
                            </x-responsive-nav-link>
                        @endforeach
                    </div>
                </div>
                <x-responsive-nav-link :href="route('tag')" :active="request()->routeIs('tag')">
                    {{ __('Tags') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('timeline')" :active="request()->routeIs('timeline')">
                    {{ __('Timeline') }}
                </x-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 px-4 {{ $FONT_FAMILY }}">
                @if(env('SCOUT_ENABLED'))
                <div class="sm:-my-px sm:mr-5 sm:flex w-full">
                    <div class="px-1 py-1 text-sm font-medium leading-5 text-gray-900">
                        <Search />
                    </div>
                </div>
                @endif
                @auth
                <div class="px-2">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500 dark:text-gray-300">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1 {{ $FONT_FAMILY }}">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link as="a" :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
                @else
                    <Link href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-200 ">{{ __('Log in') }}</Link>

                    @if (Route::has('register'))
                        <Link href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-200 ">{{ __('Register') }}</Link>
                    @endif
                @endauth
            </div>
        </div>
    </nav>
</x-splade-toggle>

<x-splade-script>
    window.addEventListener('scroll', function() {
        var div = document.getElementById('navigation');

        if (window.scrollY > div.offsetHeight) {
            div.classList.remove('bg-opacity-75', 'dark:bg-opacity-75');
            div.classList.add('bg-opacity-100', 'dark:bg-opacity-100');
        } else {
            div.classList.remove('bg-opacity-100', 'dark:bg-opacity-100');
            div.classList.add('bg-opacity-75', 'dark:bg-opacity-75');
        }
    });
</x-splade-script>
