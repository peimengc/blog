<template>
    <div class="div">
        <div class="container bg-white py-4">
            <section class="border-bottom mb-3 text-center">
                <h4>{{ item.title }}</h4>
                <small>发布时间：{{ item.created_at }}</small>
                <small>作者：{{ item.author.name }}</small>
            </section>
            <div class="row">
                <div class="col-md-12 text-break">
                    <p>
                        {{ item.contents }}
                    </p>
                </div>
            </div>
        </div>
        <div class="container bg-white my-4">
            <div v-for="reply in item.replies" :key="reply.id" class="media border-bottom py-3">
                <div class="media-body">
                    <h5 class="mt-0">
                        {{ reply.user.name}}
                        <small class="text-muted">{{ reply.create_at}}</small>
                    </h5>
                    {{ reply.contents}}
                </div>
            </div>
        </div>
        <div class="container bg-white my-4 py-4">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <form>
                        <div class="form-group">
                            <textarea class="form-control" cols="30" rows="5" v-model="replyData.contents"></textarea>
                        </div>
                        <div class="form-group float-right">
                            <button type="button" class="btn btn-primary" @click="reply">回复</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {fetchArticle} from '../../api/articles'
    import {createReply} from '../../api/replies'

    export default {
        name: "TheShow",
        data() {
            return {
                item: {
                    author: {},
                    replies: []
                },
                replyData: {
                    contents: ''
                }
            }
        },
        props: {
            id: Number
        },
        methods: {
            reply() {
                createReply(this.item.id,this.replyData).then(response => {
                    if (parseInt(response.data.status_code) === 0){
                        this.replyData.contents = ''
                        this.item.replies = _.concat(this.item.replies,response.data.data)
                        alert(response.data.status_msg)
                    }
                })
            }
        },
        computed: {},
        created() {
            fetchArticle(this.id)
                .then((response) => {
                    if (response.data.status_code === 0) {
                        this.item = response.data.data
                    }
                })
        }
    }
</script>

<style scoped>

</style>
