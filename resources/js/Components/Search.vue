<template>
    <div class="relative z-10" role="dialog" aria-modal="true">
        <div class="z-10 overflow-y-auto p-4 sm:p-6 md:p-20">
            <div class="mx-auto max-w-5xl transform divide-y divide-gray-100 dark:divide-zinc-500 overflow-hidden rounded-xl bg-white shadow-2xl ring-1 ring-black ring-opacity-5 transition-all bg-opacity-70 dark:bg-zinc-900 dark:bg-opacity-70 backdrop-blur-sm backdrop-filter">
                <div class="relative">
                    <svg class="pointer-events-none absolute left-4 top-3.5 h-5 w-5 text-gray-400 dark:text-gray-100" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                    </svg>
                    <input type="text"
                           v-model="keyword"
                           :placeholder="placeholder"
                           class="h-12 w-full border-0 bg-transparent pl-11 pr-4 text-gray-900 placeholder:text-gray-400 focus:ring-0 dark:text-gray-100 dark:placeholder:text-gray-200" role="combobox" aria-expanded="false" aria-controls="options">
                </div>

                <div v-show="keyword !== '' && results.length > 0" class="flex divide-x divide-gray-100 dark:divide-zinc-500">
                    <!-- Preview Visible: "sm:h-96" -->
                    <div class="max-h-96 min-w-0 flex-auto scroll-py-4 overflow-y-auto px-6 py-4 sm:h-96">
                        <!-- Default state, show/hide based on command palette state. -->
                        <h2 class="mb-4 mt-2 text-sm text-gray-700 dark:text-gray-300" v-html="result_title"></h2>
                        <ul class="-mx-2 text-sm text-gray-700" id="recent" role="listbox">
                            <!-- Active: "bg-gray-100 text-gray-900" -->
                            <li v-for="(result, key) in results" @click="setCurrent(key)" class="group flex cursor-default items-center rounded-md p-1 my-1 hover:bg-green-400 hover:text-gray-100 dark:text-white dark:hover:bg-gray-100 dark:hover:text-green-500" :class="{ 'bg-green-400 text-gray-100 dark:text-gray-700 dark:bg-gray-100': currentKey === key }" id="recent-1" role="option" tabindex="-1">

                                <span v-if="keyword !== '' && results.length > 0" class="flex-auto truncate text-lg" v-html="highlightMatch(result.title, keyword)"></span>
                                <!-- Not Active: "hidden" -->
                                <svg class="ml-3 h-5 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                </svg>
                            </li>
                        </ul>

                    </div>

                    <!-- Active item side-panel, show/hide based on active state -->
                    <div v-show="current" class="hidden h-96 w-1/2 flex-none flex-col divide-y divide-gray-100 overflow-y-auto sm:flex">
                        <div class="relative isolate flex flex-col justify-end overflow-hidden bg-gray-100 bg-opacity-50 dark:bg-zinc-700 dark:bg-opacity-50 px-8 pb-8 pt-80 sm:pt-48 lg:pt-80">
                            <img :src="current.image" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover">
                            <div class="absolute inset-0 -z-10 bg-gradient-to-t from-gray-100 via-gray-100/80 dark:from-gray-900 dark:via-gray-900/80"></div>
                            <div class="absolute inset-0 -z-10 ring-1 ring-inset ring-gray-100/10 dark:ring-gray-900/10"></div>

                            <h3 class="mt-3 text-lg font-semibold leading-6 text-black dark:text-white">
                                <Link :href="current.url">
                                    <span class="absolute inset-0"></span>
                                    <span v-if="current" v-html="highlightMatch(current.title, keyword)"></span>
                                </Link>
                            </h3>
                            <span class="py-5 dark:text-white" v-if="current" v-html="highlightMatch(current.meta_description, keyword)">
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Empty state, show/hide based on command palette state -->
                <div v-show="keyword !== '' && results.length == 0" class="px-6 py-14 text-center text-lg sm:px-14">
                    <p class="mt-4 text-gray-900" v-html="none_tips"></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    props: {
        placeholder: {
            type: String,
            default: "",
        },
        keywords: {
            type: String,
            default: "",
        }
    },
    data() {
        return {
            keyword: this.keywords,
            results: [],
            showMessage: false,
            current: '',
            currentKey: '',
            none_tips: '',
            result_title: '',
        };
    },
    watch: {
        keyword() {
            // 重置当前页
            this.loadResults();
            this.changeQueryParam();
        },
    },
    mounted() {
        this.loadResults();
    },
    methods: {
        changeQueryParam() {
            const newQueryParamValue = this.keyword;
            const currentURL = new URL(window.location.href);
            currentURL.searchParams.set('keyword', newQueryParamValue);

            window.history.replaceState({}, '', currentURL.toString());
        },
        loadResults() {
            axios
                .post("/search", {
                    keyword: this.keyword,
                })
                .then((response) => {
                    this.results = response.data.results;
                    this.none_tips = response.data.none_tips;
                    this.result_title = response.data.result_title;
                    if (this.results.length > 0) {
                        this.current = this.results[0];
                        this.currentKey = 0;
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        setCurrent(key) {
            this.current = this.results[key];
            this.currentKey = key;
        },
        highlightMatch(text, keyword) {
            if (!keyword) {
                return text;
            }
            const regex = new RegExp(keyword, 'gi');
            const highlightedText = text.replace(regex, '<span class="text-red-500">$&</span>');
            return highlightedText;
        }
    }
};
</script>
