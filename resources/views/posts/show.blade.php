<x-layout>
    @seoTitle($post->title)
    @seoDescription($post->meta_description)
    @seoKeywords($post->meta_keywords)

    <!-- Blog Article -->

    <div class="z-0 pb-4 pt-24 sm:pb-40 max-w-7xl mx-auto px-4">
        <div class="items-center justify-center pb-8 sm:pb-20 sm:pt-20">
            <div class="text-3xl text-center uppercase lg:text-5xl"
                 style="text-shadow: rgb(0, 0, 0) 0px 0px 0.8em, rgb(0, 0, 0) 0px 0px 0.4em;">
                <IncredibleTitle title="{{ $post->title }}"/>
            </div>
            <div class="text-center pt-12 text-white tracking-wide text-center uppercase leading-8 sm:tracking-wider"
                 style="text-shadow: rgb(0, 0, 0) 0px 0px 0.8em, rgb(0, 0, 0) 0px 0px 0.4em;">
                <span class="antd icon-folder-open-fill font-semibold text-xl pr-6"> <Link
                        href="{{ route('categories.show', $post->category) }}"
                        class="hover:text-green-500 pl-3 {{ $FONT_FAMILY }}">{{ $post->category->title }}</Link> </span>
                <span
                    class="antd icon-time-circle-fill font-semibold text-xl pr-6"> <span class="pl-3 {{ $FONT_FAMILY }}">{{ $post->published_at->format('Y'.'年'.'m'.'月'.'d'.'日'.' H:i') }}</span></span>
                <span class="antd icon-eye-fill font-semibold text-xl pr-6"><span class="pl-3 {{ $FONT_FAMILY }}">{{ $post->views }}</span></span>
                <span class="antd icon-tags-fill font-semibold text-xl">
                    @foreach($tags as $key => $tag)
                        <span class="hover:text-green-500 pl-2 {{ $FONT_FAMILY }}"><Link href="{{ route('tag', $tag['name']) }}">{{ $tag['name'] }}</Link></span>
                    @endforeach
                </span>
            </div>
        </div>

        @auth
            @if(Auth::user()->id == 1)
                <div class="mb-5 flex justify-end">
                        <span>
                          <Link href="{{ route('posts.edit', $post) }}" type="button"
                                class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-zinc-700 dark:ring-zinc-700 dark:hover:bg-zinc-900 dark:text-gray-200">
                              <span class="antd icon-edit-fill"></span>
                              <span class="pl-1">{{ __('Edit') }}</span>
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
                                return this.published ? `{{ __('Unpublish') }}` : `{{ __('Publish') }}`;
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
                            <Link href="{{ route('posts.destroy', $post->ulid) }}" method="delete"
                                  confirm="{{ __('Dangerous operation, confirm to continue?') }}"
                                  confirm-text="{{ trans('post.deletePostConfirm', ['title' => $post->title]) }}"
                                  confirm-button="{{ __('Delete Post') }}" type="button"
                                  class="inline-flex items-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                            <span class="antd icon-delete-fill"></span>
                            <span class="pl-1">{{ __('Delete') }}</span>
                          </Link>
                        </span>

                </div>
            @endif
        @endauth

        <OnThisPage content="{{ $post->content }}" updated-at="{{ $post->updated_at }}" updated-text="{{ __('Last Updated') }}" />

        <div
            class="mt-8 px-4 py-4 sm:px-4 lg:px-8 sm:py-4 lg:py-8 bg-opacity-50 text-gray-600 shadow-sm rounded-lg sm:rounded-lg bg-white dark:bg-zinc-800 dark:bg-opacity-50 dark:text-gray-200 backdrop-blur-sm backdrop-filter">
            <Comment post-id="{{ $post->ulid }}" post-slug="{{ $post->slug }}"></Comment>
        </div>
    </div>


</x-layout>
