<x-guest-layout>
    @seoTitle(__('DustinkY Blog system installation'))
    <x-install-card step="2">
        <x-splade-form action="{{ route('install.check', ['locale' => $locale]) }}" class="space-y-4">
            <h2 class="font-semibold leading-7 text-lg py-4 px-4 dark:text-gray-200">
                {{ __('Basic information of the website') }}
            </h2>
            <dl class="divide-y divide-gray-100 text-sm leading-6">
                <div class="flex justify-center py-2 px-4">
                    <dt class="font-medium sm:w-64 sm:flex-none sm:pr-6 leading-9 dark:text-gray-200">{{ __('Website name') }}</dt>
                    <dd class="flex justify-between gap-x-6 sm:flex-auto">
                        <x-splade-input id="website.name" type="text" name="website.name" placeholder="{{ __('Please enter the website name') }}" class="w-96" autofocus />
                    </dd>
                </div>
                <div class="flex justify-center py-2 px-4">
                    <dt class="font-medium sm:w-64 sm:flex-none sm:pr-6 leading-9 dark:text-gray-200">{{ __('Website address') }}</dt>
                    <dd class="flex justify-between gap-x-6 sm:flex-auto">
                        <x-splade-input id="website.address" type="text" name="website.address" placeholder="{{ __('Please enter the website address') }}" class="w-96" autofocus />
                    </dd>
                </div>
            </dl>
            <h2 class="font-semibold leading-7 text-lg py-4 px-4 dark:text-gray-200">
                {{ __('Database information') }}
            </h2>
    <dl class="divide-y divide-gray-100 text-sm leading-6">
                <div class="flex justify-center py-2 px-4">
                    <dt class="font-medium sm:w-64 sm:flex-none sm:pr-6 leading-9 dark:text-gray-200">{{ __('Database host') }}</dt>
                    <dd class="flex justify-between gap-x-6 sm:flex-auto">
                        <x-splade-input id="database.host" type="text" name="database.host" placeholder="{{ __('Please enter database host') }}" class="w-96" autofocus />
                    </dd>
                </div>
                    <div class="flex justify-center py-2 px-4">
                    <dt class="font-medium sm:w-64 sm:flex-none sm:pr-6 leading-9 dark:text-gray-200">{{ __('Database port') }}</dt>
                        <dd class="flex justify-between gap-x-6 sm:flex-auto">
                            <x-splade-input id="database.port" type="text" name="database.port" placeholder="{{ __('Please enter database port') }}" class="w-96" autofocus />
                        </dd>
                </div>
                <div class="flex justify-center py-2 px-4">
                    <dt class="font-medium sm:w-64 sm:flex-none sm:pr-6 leading-9 dark:text-gray-200">{{ __('Database name') }}</dt>
                    <dd class="flex justify-between gap-x-6 sm:flex-auto">
                        <x-splade-input id="database.name" type="text" name="database.name" placeholder="{{ __('Please enter database name') }}" class="w-96" autofocus />
                    </dd>
                </div>
                <div class="flex justify-center py-2 px-4">
                    <dt class="font-medium sm:w-64 sm:flex-none sm:pr-6 leading-9 dark:text-gray-200">{{ __('Database username') }}</dt>
                    <dd class="flex justify-between gap-x-6 sm:flex-auto">
                        <x-splade-input id="database.username" type="text" name="database.username" placeholder="{{ __('Please enter database username') }}" class="w-96" autofocus />
                    </dd>
                </div>
                <div class="flex justify-center py-2 px-4">
                    <dt class="font-medium sm:w-64 sm:flex-none sm:pr-6 leading-9 dark:text-gray-200">{{ __('Database password') }}</dt>
                    <dd class="flex justify-between gap-x-6 sm:flex-auto">
                        <x-splade-input id="database.password" type="text" name="database.password" placeholder="{{ __('Please enter database password') }}" class="w-96" autofocus />
                    </dd>
                </div>
            </dl>
            <div class="flex justify-center mt-6 gap-x-3">
                <Link href="{{ route('install.index') }}" class="bg-gray-400 px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-300">{{ __('Take a step back') }}</Link>
                <x-splade-submit class="w-full" :label="__('Detect database connections and install the system')" />
            </div>
        </x-splade-form>
    </x-install-card>
</x-guest-layout>
