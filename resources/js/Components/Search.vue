<template>
    <div class="flex flex-col" >
        <div class="relative">
            <input
                type="text"
                v-model="keyword"
                placeholder="Search"
                @keyup.enter="openSearchWindow"
                class="w-full py-2 pl-2 pr-10 rounded-lg dark:bg-zinc-800 dark:text-gray-200 border-0 ring-1 ring-gray-400 focus:ring-1 focus:ring-gray-400 bg-gray-200 bg-opacity-50 dark:bg-opacity-50"
            />
            <button
                @click="openSearchWindow"
                class="absolute inset-y-0 right-0 pr-3 flex items-center hover:bg-gray-300 dark:text-gray-200 dark:hover:bg-zinc-900 rounded-lg h-8 w-8 p-2 m-1 dark:hover:ring-1 dark:hover:ring-gray-200 "
            >
                <span class="antd icon-search text-xl"></span>
            </button>
        </div>

        <div v-if="showMessage" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-lg bg-white dark:bg-zinc-900 dark:bg-opacity-90 px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 dark:bg-gray-200 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                </svg>
                            </div>
                            <div class="mx-auto flex h-12 items-center justify-center pl-4 sm:mx-0 sm:h-10">
                                <h3 class="text-xl leading-6 text-gray-900 dark:text-gray-100" id="modal-title">请输入搜索关键词</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="showSearchWindow" class="relative z-10">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full justify-center p-4 text-center sm:items-center sm:p-0 dark:text-gray-100">
                    <div class="relative transform overflow-hidden rounded-lg bg-white dark:bg-zinc-900 dark:bg-opacity-90 px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                        <div class="absolute right-0 top-0 hidden pr-4 pt-4 sm:block">
                            <button @click="closeSearchWindow" type="button" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                <span class="sr-only">Close</span>
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="sm:items-start">
                            <h1 v-if="search !== ''" class="text-xl font-bold mb-4 justify-start">{{ search }} 的搜索结果</h1>
                            <h1 v-else class="text-xl font-bold mb-4 justify-start">请输入搜索关键词</h1>
                            <div class="relative">
                                <input
                                    type="text"
                                    v-model="search"
                                    placeholder="Search"
                                    class="w-full py-2 pl-2 pr-10 rounded-lg dark:bg-zinc-800 dark:text-gray-200 border-0 ring-1 ring-gray-300 focus:ring-1 focus:ring-gray-300 bg-gray-200 bg-opacity-50 dark:bg-opacity-50"
                                />
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="antd icon-search text-xl"></span>
                                </div>
                            </div>
                            <div v-if="loading" class="flex flex-col">
                                <span class="py-6 justify-center text-center text-base">
                                    <span class="rotate-on-hover antd icon-reload text-lg ml-auto"></span>
                                    正在搜索中...
                                </span>
                            </div>
                            <div v-else-if="results.length > 0" class="flex flex-col">
                                <div
                                    v-for="result in results"
                                    :key="result.id"
                                    class="py-3 px-4 hover:bg-gray-300 rounded-2xl mt-4 dark:hover:bg-zinc-600 dark:hover:bg-opacity-50"
                                >
                                    <Link :href="result.url">
                                        <h2 class="text-lg font-bold line-clamp-1" v-html="highlightMatch(result.title, search)"></h2>
                                        <p class="text-gray-500 line-clamp-2 dark:text-gray-300" v-html="highlightMatch(result.meta_description, search)"></p>
                                    </Link>
                                </div>
                            </div>
                            <div v-else class="flex flex-col">
                                <span class="py-6 justify-center text-center text-base">
                                    没有找到与 <span class="font-bold">{{ search }}</span> 相关的结果
                                </span>
                            </div>
                        </div>
                        <div v-if="total !== 0" class="flex flex-row justify-between items-center mt-5 sm:mt-4">
                            <div class="flex-initial text-left text-gray-500 dark:text-gray-300">
                                共有 <span class="font-bold">{{ total }}</span> 条数据，当前第 <span class="font-bold">{{ currentPage }}</span> 页，总共 <span class="font-bold">{{ totalPages }}</span> 页。
                            </div>
                            <div class="flex-initial text-right">
                                <button type="button" @click="nextPage" v-if="currentPage !== totalPages" class="inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:ml-3 sm:w-auto">下一页</button>
                                <button type="button"  @click="previousPage" v-if="currentPage !== 1" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">上一页</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    props: {
        fontFamily: {
            type: String,
            default: "",
        },
    },
    data() {
        return {
            search: "",
            keyword: "",
            results: [],
            showSearchWindow: false,
            showMessage: false,
            currentPage: 1,
            pageSize: 5,
            totalPages: 0,
            total: 0,
            loading: false,
        };
    },
    watch: {
        search() {
            // 重置当前页
            this.currentPage = 1;

            this.totalPages = 0;
            this.total = 0;
            this.loadResults();
        },
        currentPage() {
            // 加载当前页的结果
            this.loadResults();
        },
    },
    methods: {
        openSearchWindow() {
            if (this.keyword.length > 0) {
                this.showSearchWindow = true;
                this.search = this.keyword;
            } else {
                this.showMessage = true;
                setTimeout(() => {
                    this.showMessage = false;
                }, 2000);
            }
        },
        closeSearchWindow() {
            this.showSearchWindow = false;
            this.keyword = "";
            this.results = [];
            this.search = "";
            this.totalPages = 0;
            this.total = 0;
        },
        loadResults() {
            this.loading = true;
            axios
                .get("/search", {
                    params: {
                        keyword: this.search,
                        page: this.currentPage,
                        pageSize: this.pageSize,
                    },
                })
                .then((response) => {
                    this.results = response.data.results;
                    this.totalPages = response.data.totalPages;
                    this.total = response.data.total;
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        previousPage() {
            this.currentPage--;
        },
        nextPage() {
            this.currentPage++;
        },
        highlightMatch(text, keyword) {
            if (!keyword) {
                return text;
            }
            const regex = new RegExp(keyword, 'gi');
            const highlightedText = text.replace(regex, '<span class="text-red-500">$&</span>');
            return highlightedText;
        }
    },
    computed: {
        paginatedResults() {
            const startIndex = (this.currentPage - 1) * this.pageSize;
            const endIndex = this.currentPage * this.pageSize;
            return this.results.slice(startIndex, endIndex);
        },
    },
};
</script>
<style>

.rotate-on-hover {
    display: inline-block;
    animation: rotate 2s infinite steps(100);
}

@keyframes rotate {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>
