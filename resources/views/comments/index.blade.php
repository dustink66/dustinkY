<x-app-layout>
    @seoTitle(__('Comment Management'))
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
                {{ __('Comment Management') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            <x-splade-table :for="$comments">
                <x-splade-cell actions>
                    <div class="space-x-2">
                        <Link href="{{ route('posts.show', $item->post) }}"> {{ __('Show Post') }} </Link>
                        <Link class="text-red-600 hover:text-red-400" href="{{ route('comments.destroy', $item->id) }}" method="delete" confirm="{{ __('Dangerous operation, confirm to continue?') }}" confirm-text="{{ __('Are you sure to delete this comment?') }}"> {{ __('Delete') }} </Link>
                    </div>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-app-layout>
