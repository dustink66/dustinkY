<template>
    <div>
        <VueMultiselect
            v-model="taggingSelected"
            :options="taggingOptions"
            :multiple="true"
            :taggable="true"
            @tag="addTag"
            @remove="toggleUnSelectMarket"
            @select="toggleSelectMarket"
            tag-placeholder="添加为新标签"
            placeholder="请输入标签进行搜索或者添加"
            select-label="按回车键添加"
            deselect-label="删除标签"
            selected-label="已选标签"
            label="name"
            track-by="id"
        />
    </div>
</template>

<script>
import VueMultiselect from 'vue-multiselect'
export default {
    props: {
        postId: {
            type: Number,
            default: 0
        }
    },
    components: { VueMultiselect },
    data() {
        return {
            taggingSelected: [],
            taggingOptions: [
            ]
        }
    },
    mounted() {
        axios.get('/tags').then(response => {
            this.taggingOptions = response.data
        })
        axios.get('/posts/' + this.postId + '/tags').then(response => {
            this.taggingSelected = response.data
        })
    },
    methods: {
        toggleSelectMarket({ value, id }) {
            axios.post('/posts/' + this.postId + '/tags', { tag_id: id }).then(response => {
                console.log(response.data)
            })
        },
        toggleUnSelectMarket({ value, id }) {
            this.toggleUnSelectLojas(value, id);
        },
        toggleUnSelectLojas(value, id) {
            console.log(" Teste toggleUnSelectLojas id : ", id);
            axios.delete('/posts/' + this.postId + '/tags', { data: { tag_id: id } }).then(response => {
                console.log(response.data)
            })
        },
        addTag(newTag) {
            const tag = {
                name: newTag
            }
            axios.post('/tags', tag).then(response => {
                const nTag = {
                    id: response.data.id,
                    name: response.data.name
                }
                this.taggingOptions.push(nTag)
                this.taggingSelected.push(nTag)
                const tags = {
                    tag_id: response.data.id
                }
                axios.post('/posts/' + this.postId + '/tags', tags).then(response => {
                    console.log(response.data)
                })
            })
        }
    }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css">

</style>
