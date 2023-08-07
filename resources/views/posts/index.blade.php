<x-app-layout>
    @seoTitle(__('Blog Posts'))
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
                {{ __('Blog Posts') }}
            </h2>
            <Link href="{{ route('posts.create') }}" type="button" class="inline-flex items-center rounded-md bg-green-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-400">
                <span class="antd icon-plus"></span>
                <span class="pl-1">{{ __('Create Post') }}</span>
            </Link>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4">
            @foreach ($posts as $post)
                <div class="lg:flex lg:items-center lg:justify-between bg-white bg-opacity-75 overflow-hidden shadow-sm sm:rounded-lg dark:bg-zinc-900 dark:bg-opacity-75 px-4 py-4 transform hover:scale-105 transition duration-300 mb-5">
                    <div class="min-w-0 flex-1">
                        <h2 class="leading-7 text-gray-800 sm:truncate sm:text-2xl sm:tracking-wider dark:text-gray-200"><span class="antd icon-biaoti text-2xl mr-2"></span>{{ $post->title }}</h2>
                        <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
                            <div class="mt-2 flex items-center text-sm text-gray-600 dark:text-gray-300">
                                <span class="antd icon-time-circle-fill"><span class="pl-1 {{ $FONT_FAMILY }}">{{ $post->created_at->format('Y-m-d h:m:s') }}</span></span>
                            </div>
                            <div class="mt-2 flex items-center text-sm text-gray-600 dark:text-gray-300">
                                <span class="antd icon-folder-open-fill"><span class="pl-1 {{ $FONT_FAMILY }}">{{ $post->category->title }}</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 flex lg:ml-4 lg:mt-0">
                        <span>
                          <Link href="{{ route('posts.edit', $post) }}" type="button" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-zinc-700 dark:ring-zinc-700 dark:hover:bg-zinc-900 dark:text-gray-200">
                              <span class="antd icon-edit-fill"></span>
                              <span class="pl-1">{{ __('Edit') }}</span>
                          </Link>
                        </span>

                        <span class="lg:ml-3 ml-1">
                          <a href="{{ route('posts.show', $post) }}" target="_blank" type="button" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-zinc-700 dark:ring-zinc-700 dark:hover:bg-zinc-900 dark:text-gray-200">
                            <span class="antd icon-eye-fill"></span>
                            <span class="pl-1">{{ __('View') }}</span>
                          </a>
                        </span>

                        <span class="lg:ml-3 ml-1">
                          <Link href="{{ route('posts.comments', $post) }}" type="button" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-zinc-700 dark:ring-zinc-700 dark:hover:bg-zinc-900 dark:text-gray-200">
                            <span class="antd icon-comment-fill"></span>
                            <span class="pl-1">{{ __('Comment Management') }}</span>
                          </Link>
                        </span>

                        <span class="lg:ml-3 ml-1">
                            <div x-data="{
                              published: {{ $post->published }},
                              toggle() {
                                this.published = !this.published;
                                axios.patch('{{ route('posts.update', $post) }}', {
                                  published: this.published
                                });
                              },
                              publishedStatus() {
                                return this.published ? `&nbsp;{{ __('Unpublish') }}` : `&nbsp;{{ __('Publish') }}`;
                              }
                            }">
                                <button x-on:click="toggle()"
                                        class="inline-flex items-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600"
                                        x-bind:class="{ 'bg-orange-500 hover:bg-orange-400': published }">
                                    <span class="antd icon-publish" x-bind:class="{ 'icon-unpublish': published }"></span>
                                    <span class="pl-1" x-text="publishedStatus()"></span>
                                </button>
                            </div>
                        </span>

                        <span class="lg:ml-3 ml-1">
                            <Link href="{{ route('posts.destroy', $post) }}" method="delete" confirm="{{ __('Dangerous operation, confirm to continue?') }}" confirm-text="{{ trans('post.deletePostConfirm', ['title' => $post->title]) }}"
                                  confirm-button="{{ __('Delete Post') }}" type="button" class="inline-flex items-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                            <span class="antd icon-delete-fill"></span>
                            <span class="pl-1">{{ __('Delete') }}</span>
                          </Link>
                        </span>

                    </div>
                </div>

            @endforeach
            <div class="mt-5">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
