<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg dark:bg-zinc-900">
            <div {{ $attributes->class(['p-6 sm:px-20 bg-white border-b border-gray-200 dark:border-zinc-800 dark:bg-zinc-900' => true]) }}>
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
