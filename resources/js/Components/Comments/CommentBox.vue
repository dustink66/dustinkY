<template>
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
                            <h3 class="text-xl leading-6 text-gray-900 dark:text-gray-100" id="modal-title">{{ errorInfo }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div :id="parentId" class="flex items-start space-x-4">
        <div class="flex-shrink-0">
            <div v-if="userInfo.avatar" class="h-16 w-16 rounded-full ring-2 ring-gray-100 bg-white">
                <img :src="userInfo.avatar" alt="" class="w-full block h-full object-contain rounded-full">
            </div>
            <span v-else class="inline-flex h-16 w-16 items-center justify-center rounded-full bg-green-500">
                <span class="text-4xl font-medium leading-none text-white">{{ userInfo.name.charAt(0) }}</span>
            </span>
        </div>
        <div class="min-w-0 flex-1">
            <div class="relative">
                <div class="overflow-hidden rounded-lg shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-green-400">
                    <label for="comment" class="sr-only">请输入你的评论</label>
                    <textarea rows="3" name="comment" id="comment" class="block w-full resize-none border-0 bg-transparent py-1.5 text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-0 sm:text-base sm:leading-6" placeholder="请输入你的评论..." v-model="commentContent"></textarea>
                    <div class="py-2" aria-hidden="true">
                        <div class="py-px">
                            <div class="h-9"></div>
                        </div>
                    </div>
                </div>

                <div class="absolute inset-x-0 bottom-0 flex justify-between py-2 pl-3 pr-2">
                    <div class="flex items-center space-x-5">
                        <div class="flex items-center">
                            <input id="comments-checkbox" name="comments-checkbox" type="checkbox" class="h-4 w-4 text-green-500 focus:ring-green-400 border-gray-300 rounded">
                            <label for="comments-checkbox" class="ml-2 block text-base text-gray-900 dark:text-white">
                                <span class="sr-only">Enable notifications</span>
                                <span>有评论通知我</span>
                            </label>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <button @click="submitComment" class="inline-flex px-3 rounded text-secondary bg-green-500 text-white hover:bg-green-400 items-center space-x-2">
                            <span class="antd icon-publish text-xl"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        userInfo: {
            type: Object,
            required: true
        },
        postId: {
            type: String,
            required: true
        },
        parentId: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            commentContent: '',
            showMessage: false,
            errorInfo: ''
        };
    },
    methods: {
        submitComment() {
            // 获取评论内容
            const content = this.commentContent.trim();
            if (!content) {
                return;
            }
            const parentId = this.parentId === '0' ? null : this.parentId;
            axios.post('/comments', {
                post_id: this.postId,
                parent_id: parentId,
                content
            }).then(response => {
                this.$emit('commented', parentId);
                this.commentContent = '';
            }).catch(error => {
                this.showMessage = true;
                this.errorInfo = error.response.data.message;
                setTimeout(() => {
                    this.showMessage = false;
                    this.errorInfo = '';
                }, 2000);
            });
        }
    }
};
</script>
