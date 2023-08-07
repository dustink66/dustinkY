<x-guest-layout>
    @seoTitle(__('DustinkY Blog system installation'))
    <x-install-card step="1">
        <div class="leading-10 p-3">
            <div class="flex justify-between">
                <select id="language-select" class="rounded-md bg-opacity-80 focus:ring-green-500 focus:ring-2 ring-1 ring-gray-300 border-0">
                    @foreach($locales as $item)
                        @if($item['code'] == $locale)
                            <option value="{{ $item['code'] }}" selected>{{ $item['name'] }}</option>
                        @else
                            <option value="{{ $item['code'] }}">{{ $item['name'] }}</option>
                        @endif
                    @endforeach
                    <!-- 其他语言选项 -->
                </select>

                <ThemeSwitch class="ml-5 pt-1" />
            </div>
            <h1 class="text-2xl font-semibold text-center py-6 dark:text-white">{{ __('DustinkY Blog system installation protocol') }}</h1>
            {!! trans('install.welcome') !!}
        </div>
        <div class="flex justify-center mt-6 gap-x-3">
            <Link href="{{ route('install.settings', ['locale' => $locale]) }}" class="bg-green-500 px-4 py-2 rounded-md text-white hover:bg-green-400">{{ __('Agree to the agreement and continue') }}</Link>
        </div>
    </x-install-card>
</x-guest-layout>
<x-splade-script>
    document.getElementById('language-select').addEventListener('change', function() {
    var selectedLanguage = this.value;
    window.location.href = '/select-locale/' + selectedLanguage;
    });
</x-splade-script>
