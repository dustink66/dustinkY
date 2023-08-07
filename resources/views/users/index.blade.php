<x-app-layout>
    @seoTitle(__('Users Management'))
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
                {{ __('Users Management') }}
            </h2>
            <Link href="{{ route('users.create') }}" type="button" class="inline-flex items-center rounded-md bg-green-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-400">
                <span class="antd icon-plus"></span>
                <span class="pl-1">{{ __('Create User') }}</span>
            </Link>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4">
            <x-splade-table :for="$users">
                <x-splade-cell actions>
                    <div class="space-x-2">
                        <Link href="{{ route('users.edit', $item) }}"> {{ __('Edit') }} </Link>
                        <Link class="text-red-600 hover:text-red-400" href="{{ route('users.destroy', $item->id) }}" method="delete" confirm="{{ __('Dangerous operation, confirm to continue?') }}" confirm-text="{{ trans('user.deleteUserConfirm', ['name' => $item->name]) }}"> {{ __('Delete') }} </Link>
                    </div>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-app-layout>
