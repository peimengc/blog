<template>
    <div class="container bg-white py-4">
        <section class="border-bottom mb-3">
            <h4>{{ header }}</h4>
        </section>
        <div class="row justify-content-center">
            <div class="col-md-8">

                <form>
                    <div class="form-group">
                        <label for="title">标题</label>
                        <input type="text"
                               id="title"
                               class="form-control"
                               :class="{'is-invalid':hasError('title')}"
                               v-model="title">
                        <div v-if="hasError('title') > 0" class="invalid-feedback">
                            {{ errorText('title') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contents">内容</label>
                        <textarea type="text"
                                  class="form-control"
                                  id="contents"
                                  :class="{'is-invalid':hasError('contents')}"
                                  v-model="contents"></textarea>
                        <div v-if="hasError('contents') > 0" class="invalid-feedback">
                            {{ errorText('contents') }}
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" @click="submit">发布</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "TheCreate",
        data() {
            return {
                title: '',
                contents: '',
                errors: null
            }
        },
        props: {
            id: Number
        },
        methods: {
            submit() {
                if (this.id)
                    this.update()
                else
                    this.store()
            },
            store() {
                axios.post('/api/articles', this.$data)
                    .then((response) => {
                        if (response.data.status_code === 0) {
                            alert(response.data.status_msg)
                            location.replace('/articles')
                        }
                    })
                    .catch((error) => {
                        //表单验证失败
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors
                        }
                    })
            },
            update() {
                axios.put('/api/articles/' + this.id, this.$data)
                    .then((response) => {
                        if (response.data.status_code === 0) {
                            alert(response.data.status_msg)
                            location.replace('/articles')
                        }
                    })
                    .catch((error) => {
                        //表单验证失败
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors
                        }
                    })
            },
            errorText(key) {
                return _.get(this.errors, [key, '0'])
            },
            hasError(key) {
                return _.get(this.errors, [key], []).length
            }

        },
        computed: {
            header: function () {
                return this.id ? '编辑文章' : '创建文章'
            }
        },
        created() {
            if (this.id) {
                axios.get('/api/articles/' + this.id)
                    .then((response) => {
                        if (response.data.status_code === 0) {
                            this.title = response.data.data.title
                            this.contents = response.data.data.contents
                        }
                    })
            }
        }
    }
</script>

<style scoped>

</style>
