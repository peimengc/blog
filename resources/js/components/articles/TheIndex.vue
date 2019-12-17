<template>
    <div class="container bg-white py-4">
        <section class="border-bottom pb-3">
            <div class="form-inline">
                <input class="form-control mr-sm-2" type="text" v-on:keyup.enter="search" placeholder="Search" v-model="query.search">
                <button class="btn btn-outline-success" type="button" @click="search">Search</button>
            </div>
        </section>
        <div class="row">
            <div v-for="item in list" :key="item.id" class="col-md-12 text-break">
                <div class="py-2 border-bottom">
                    <h3>{{ item.title }}</h3>
                    <p>
                        <a :href="'/articles/'+item.id">{{ item.contents }}</a>
                    </p>
                    <span>{{ item.created_at }}</span>
                    <span class="pl-3">{{ item.updated_at }}</span>
                    <div class="float-right">
                        <a class="btn btn-sm btn-primary" :href="'/articles/'+item.id+'/edit'">编辑</a>
                        <a class="btn btn-sm btn-danger" @click="destroy(item.id)">删除</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "TheIndex",
        data() {
            return {
                list: null,
                query: {
                    search: ''
                },
                pageInfo: null
            }
        },
        methods: {
            search() {
                this.getList();
            },
            getList() {
                axios.get('/api/articles',{
                    params:this.query
                })
                    .then((response) => {
                        if (response.data.status_code === 0) {
                            this.list = response.data.data.data
                            this.pageInfo = response.data.data
                        }
                    })
            },
            destroy(id, event) {
                if (confirm('确认删除？'))
                axios.delete('/api/articles/' + id)
                    .then((response) => {
                        if(response.data.status_code === 0){
                            this.list = _.filter(this.list,function (item) {
                                return parseInt(item.id) !== parseInt(id)
                            })
                        }
                    })
            }
        },
        created() {
            this.getList();
        }
    }
</script>

<style scoped>

</style>
