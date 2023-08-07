<x-app-layout>
    @seoTitle(__('Post Edit'))
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Post Edit') }}
        </h2>
        <div class="flex justify-between w-full mt-4 dark:text-gray-200">
            <div class="mb-2 flex-grow flex justify-between rounded-lg bg-gray-100 bg-opacity-50 text-black pr-3 pl-3 mr-3 dark:invert">
                <div class="flex-shrink justify-start text-xl leading-8 py-2">
                    {{ route('posts.index') }}/
                </div>
                <div class="flex-grow pr-3 leading-8 -ml-3"
                     x-data="{
                    slug: '{{ $post->slug }}',
                    init() {
                        this.$watch('slug', (value) => {
                            axios.patch('{{ route('posts.update', $post) }}', { slug: value })
                                .then(response => {
                                    console.log(response)
                                })
                        })
                    }
                }"
                >
                    <input type="text" x-model.debounce.3000ms="slug" class="w-full text-xl focus:ring-0 leading-8 border-0 bg-transparent">
                </div>
            </div>
            <div class="flex flex-shrink pr-3 leading-8 py-2"
                x-data="{
                    published_at: '{{ $post->published_at }}',
                    init() {
                        this.$watch('published_at', (value) => {
                            axios.patch('{{ route('posts.update', $post) }}', {
                                published_at: value
                            })
                        })
                    }
                }"
            >
                <label class="mr-2">{{ __('Publish Date') }}</label>
                <input type="datetime-local" name="published_at" x-model.debounce.3000ms="published_at" class="-mt-2 focus:ring-0 outline-none border-0 border-gray-300 px-4 py-3 rounded-md bg-gray-100 bg-opacity-80 text-black dark:invert">
            </div>
            <div class="flex-shrink flex justify-end">
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
                <button x-on:click="toggle()" x-text="publishedStatus()" class="antd icon-publish px-4 py-1 mt-1 leading-8 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-lg active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green" x-bind:class="{ 'icon-unpublish bg-orange-500 hover:bg-orange-400': published }"></button>
                </div>
            </div>
        </div>
    </x-slot>
    <div class="pt-16 pb-6 relative z-0">
        <WangEditor title-value="{{ $post->title }}" content="{{ $post->content }}" url="{{ route('posts.update', $post) }}" uploadImageUrl="{{ route('upload.image') }}" uploadVideoUrl="{{ route('upload.video') }}" checkUrl="{{ route('upload.check_exists') }}" />
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sm:py-1 lg:px-8 dark:bg-zinc-900 bg-opacity-80 dark:bg-opacity-80">
                <div class="sm:grid sm:grid-cols-12 sm:items-start sm:gap-4 sm:py-3" x-data="{
                    toggle(category_id) {
                        axios.patch('{{ route('posts.update', $post) }}', {
                            category_id: category_id
                        })
                    },
                }">
                    <label for="category_id" class="block font-medium leading-6 text-gray-700 py-4 flex-shrink dark:text-gray-200 sm:pt-1.5">{{ __('Select Category') }}</label>
                    <div class="mt-2 sm:col-span-11 sm:mt-0">
                        <select id="category_id" x-on:change="toggle($event.target.value)" name="category_id" class="pl-3 block w-full focus:ring-0 flex-grow py-2 outline-none border-0 sm:rounded-lg bg-gray-100 bg-opacity-80 text-gray-800 dark:bg-zinc-700 dark:text-gray-300 form-select sm:max-w-6xl">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>
                                    {{ str_repeat('-', $category->depth) }} {{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="sm:grid sm:grid-cols-12 sm:items-start sm:gap-4 sm:py-3" x-data="{
                    meta_keywords: '{{ $post->meta_keywords }}',
                    init() {
                        this.$watch('meta_keywords', (value) => {
                            axios.patch('{{ route('posts.update', $post) }}', {
                                meta_keywords: value
                            })
                        })
                    }
                }"
                >
                    <label for="meta_keywords" class="block font-medium leading-6 text-gray-700 py-4 flex-shrink dark:text-gray-200 sm:pt-1.5">{{ __('Post Keywords') }}</label>
                    <div class="mt-2 sm:col-span-11 sm:mt-0">
                        <input type="text" name="meta_keywords" id="meta_keywords" x-model.debounce.3000ms="meta_keywords" class="block w-full max-w-6xl focus:ring-0 flex-grow py-2 outline-none border-0 sm:rounded-lg bg-gray-100 bg-opacity-80 text-gray-800 dark:bg-zinc-700 dark:text-gray-300">
                    </div>
                </div>
                <div class="sm:grid sm:grid-cols-12 sm:items-start sm:gap-4 sm:py-3" x-data="{
                    meta_description: '{{ $post->meta_description }}',
                    init() {
                        this.$watch('meta_description', (value) => {
                            axios.patch('{{ route('posts.update', $post) }}', {
                                meta_description: value
                            })
                        })
                    }
                }"
                >
                    <label for="meta_description" class="block font-medium leading-6 text-gray-700 py-4 flex-shrink dark:text-gray-200 sm:pt-1.5">{{ __('Post Description') }}</label>
                    <div class="mt-2 sm:col-span-11 sm:mt-0">
                        <textarea id="about" name="about" x-model.debounce.3000ms="meta_description" rows="3" class="block w-full max-w-6xl focus:ring-0 flex-grow py-2 outline-none border-0 sm:rounded-lg bg-gray-100 bg-opacity-80 text-gray-800 dark:bg-zinc-700 dark:text-gray-300"></textarea>
                    </div>
                </div>
                <div class="sm:grid sm:grid-cols-12 sm:items-start sm:gap-4 sm:py-3">
                    <label class="block font-medium leading-6 text-gray-700 py-4 flex-shrink dark:text-gray-200 sm:pt-1.5">{{ __('Post Thumbnail') }}</label>
                    <div class="sm:col-span-11 sm:mt-0">
                        <UploadImage check-url="{{ route('upload.check_exists') }}" upload-url="{{ route('upload.image') }}" input-key="image" button-text="{{ __('Post Image') }}" save-url="{{ route('posts.update', $post) }}" image-url="{{ $post->image }}"/>
                    </div>
                </div>
                <div class="sm:grid sm:grid-cols-12 sm:items-start sm:gap-4 sm:py-3">
                    <label class="block font-medium leading-6 text-gray-700 py-4 flex-shrink dark:text-gray-200 sm:pt-1.5">{{ __('Background Image') }}</label>
                    <div class="sm:col-span-11 sm:mt-0 py-2">
                        <Switch text="{{ __('yes|no') }}" :value="{{ $post->background_image }}" input-key="background_image" save-url="{{ route('posts.update', $post) }}" />
                    </div>
                </div>


                <div class="sm:grid sm:grid-cols-12 sm:items-start sm:gap-4 sm:py-3">
                    <label class="block font-medium leading-6 text-gray-700 py-4 flex-shrink dark:text-gray-200 sm:pt-1.5">{{ __('Post Tags') }}</label>
                    <div class="mt-2 sm:col-span-11 sm:mt-0">
                        <tag-search post-id="{{ $post->ulid }}" class="block w-full max-w-6xl dark:invert"></tag-search>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
