@props(['categories', 'is_child' => false])
<ul :class="{'ml-10': {{ $is_child ? 'true' : 'false' }}}">
@foreach($categories as $key => $item)
        <li class="dark:text-gray-200 bg-gray-300 bg-opacity-50 hover:bg-opacity-100 dark:bg-gray-500 dark:bg-opacity-50 dark:hover:bg-zinc-700 sm:rounded-lg my-5">
            <div class="flex-row justify-between items-center">
                <div class="lg:flex lg:items-center lg:justify-between  overflow-hidden shadow-sm px-4 py-4">
                    <div class="min-w-0 flex-1">
                        <h2 class="leading-7 text-gray-800 sm:truncate sm:text-2xl sm:tracking-wider dark:text-gray-200"><span class="antd icon-biaoti text-2xl mr-2"></span>{{ $item->title }}</h2>
                        <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
                            <div class="mt-2 flex items-center text-sm text-gray-600 dark:text-gray-300">
                                <span class="antd icon-time-circle-fill mr-4"><span class="pl-1 {{ $FONT_FAMILY }}">{{ $item->created_at }}</span></span>
                                <span class="antd icon-daihao"><span class="pl-1 {{ $FONT_FAMILY }}">{{ $item->slug }}</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 flex lg:ml-4 lg:mt-0">
                            <span class="hidden sm:block">
                              <Link href="{{ route('categories.edit', $item->id) }}" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-zinc-700 dark:ring-zinc-700 dark:hover:bg-zinc-900 dark:text-gray-200">
                                  <span class="antd icon-edit-fill"></span>
                                  <span class="pl-1">{{ __('Edit') }}</span>
                              </Link>
                            </span>
                            <span class="lg:ml-3 ml-1">
                              <a href="{{ route('categories.show', $item) }}" target="_blank" type="button" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-zinc-700 dark:ring-zinc-700 dark:hover:bg-zinc-900 dark:text-gray-200">
                                <span class="antd icon-eye-fill"></span>
                                <span class="pl-1">{{ __('View') }}</span>
                              </a>
                            </span>
                        <span class="sm:ml-3">
                                <Link href="{{ route('categories.destroy', $item->id) }}" method="delete" confirm="{{ __('Dangerous operation, confirm to continue?') }}" confirm-text="{{ trans('category.deleteCategoryConfirm', ['title' => $item->title]) }}"
                                      confirm-button="{{ __('Delete Category') }}" type="button" class="inline-flex items-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                    <span class="antd icon-delete-fill"></span>
                                    <span class="pl-1">{{ __('Delete') }}</span>
                                </Link>
                            </span>

                    </div>
                </div>
            </div>
        </li>
    @if($item->children->count() > 0)
        <x-category-list :categories="$item->children" :is_child="true"></x-category-list>
    @endif
@endforeach

</ul>
