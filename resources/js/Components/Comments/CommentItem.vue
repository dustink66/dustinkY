<template>
    <ul class="comments space-y-4" :class="IsSon ? 'ml-14 ' + fontFamily : fontFamily">
        <li class="block mt-4" v-for="comment in CommentList" :key="comment.id">
            <div class="flex p-4 rounded-lg bg-gray-300 bg-opacity-50 hover:bg-opacity-100 dark:bg-zinc-700 dark:bg-opacity-50 dark:hover:bg-opacity-100">
                <div class="flex-none">
                    <div v-if="comment.user.avatar" class="h-16 w-16 rounded-full mr-4">
                        <img :src="comment.user.avatar" alt="" class="w-full block h-full object-contain rounded-full">
                    </div>
                    <span v-else class="inline-flex h-16 w-16 items-center justify-center rounded-full mr-4 bg-green-500">
                          <span class="text-4xl font-medium leading-none text-white">{{ comment.user.name.charAt(0) }}</span>
                    </span>
                </div>
                <div class="flex-1">
                    <div class="flex flex-wrap justify-between">
                        <div>
                            <span class="font-semibold mr-2">{{ comment.user.name }}</span>
                        </div>
                        <div v-if="userInfo">
                            <button v-if="showCommentBox[comment.id]" @click="toggleCommentBox(comment.id)" class="inline-flex px-3 py-1 rounded text-secondary bg-red-500 text-white hover:bg-red-400 items-center space-x-2">
                                <span>关闭</span>
                            </button>
                            <button v-else @click="toggleCommentBox(comment.id)" class="inline-flex px-3 py-1 rounded text-secondary bg-green-500 text-white hover:bg-green-400 items-center space-x-2">
                                <span>评论</span>
                            </button>
                        </div>
                        <div v-else>
                            <Link :href="'/login?callback=/posts/' + postSlug" class="inline-flex px-3 py-1 rounded text-secondary bg-green-500 text-white hover:bg-green-400 items-center space-x-2">
                                <span>登录后评论</span>
                            </Link>
                        </div>
                    </div>
                    <p class="pb-1">{{ comment.content }}</p>
                    <span v-time="comment.created_at" class="text-sm text-gray-400"></span>
                </div>
            </div>
            <div class="mt-4">
                <CommentBox v-if="showCommentBox[comment.id]" :parentId="comment.id" :postId="postId" :userInfo="userInfo" @commented="refresh"  />
            </div>
            <CommentItem v-if="comment.replies" :CommentList="comment.replies" :postId="postId" :userInfo="userInfo" :postSlug="postSlug" @commented="refresh" :IsSon="true"  />
        </li>
    </ul>
</template>

<script>
import CommentBox from './CommentBox.vue';

export default {
    props: {
        postSlug: {
            type: String,
            required: true
        },
        userInfo: {
            type: Object,
            required: true
        },
        postId: {
            type: String,
            required: true
        },
        CommentList: {
            type: Array,
            required: true
        },
        IsSon: {
            type: Boolean,
            default: false
        }
    },

    components: {
        CommentBox,
    },

    data() {
        return {
            showCommentBox: {}
        }
    },
    methods: {
        toggleCommentBox(commentId) {
            this.showCommentBox[commentId] = !this.showCommentBox[commentId];
        },
        refresh(comment) {
            this.$emit('commented', comment);
            this.showCommentBox[comment] = false;
        }
    }
}
</script>
