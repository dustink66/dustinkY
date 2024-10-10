<template>
    <div class="pb-6 text-3xl font-semibold">
        <h1>雁过留痕</h1>
    </div>
    <CommentBox v-if="user"  parent-id="0" :postId="postId" @commented="getComments" :userInfo="user" />
    <div v-else class="py-6 text-xl text-center" >
        请<Link :href="'/login?callback=/posts/' + postSlug" class="text-green-500"> 登录 </Link>后发表评论
    </div>
    <div v-if="count">
        <div class="py-6 text-xl" >
            共有 <span class="font-semibold text-2xl text-green-600"> {{ count }} </span> 条评论
        </div>
        <CommentItem :CommentList="comments" :post-id="postId" :IsSon="false" :postSlug="postSlug" :userInfo="user" @commented="getComments"  />
    </div>
    <div v-else class="text-center m-auto justify-center items-center">
        <NoMessage class="max-w-xl mx-auto"/>
        <span class="text-xl" >暂无评论，期待你的参与</span>
    </div>
</template>

<script>
import CommentBox from "./Comments/CommentBox.vue";
import CommentItem from "./Comments/CommentItem.vue";
import NoMessage from "./Lotties/NoMessage.vue";
export default {
    components: {
        CommentBox,
        CommentItem,
        NoMessage
    },
    props: {
        postSlug: {
            type: String,
            required: true
        },
        postId: {
            type: String,
            required: true
        },
    },
    data() {
        return {
            comments: [],
            count: 0,
            user: null
        }
    },
    created() {
        this.checkAuth();
        this.getComments();
    },
    methods: {
        getComments() {
            axios.get('/comments/post/' + this.postId).then(response => {
                this.comments = response.data.tree;
                this.count = response.data.count;
            });
        },
        checkAuth() {
            axios.get('/is_login')
                .then(response => {
                    if (response.data.code === 200) {
                        this.user = response.data.data;
                    } else {
                        this.user = null;
                    }
                })
                .catch(error => {
                    this.user = null;
                });
        },
    }
};

</script>

<style></style>
