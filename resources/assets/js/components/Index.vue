<template>
    <div>
        <h1 class="mb-5">Сотрудники компании</h1>
        <a href="/add"><div class="btn btn-success mb-3">Добавить сотрудника</div></a>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Имя</th>
                <th>Должность</th>
                <th>Дата рождения</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <tr v-if="index.length === 0 && !errored && !loading"><td colspan="5" class="text-center">Список пуст.</td></tr>
            <tr v-if="loading"><td colspan="5" class="text-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </td></tr>
            <tr v-if="errored"><td colspan="5" class="alert alert-danger text-center">Ошибка загрузки данных!</td></tr>
            <tr v-for="index in index" v-bind:key="index.id">
                <th scope="row">{{ index.id }}</th>
                <td>{{ index.name }}</td>
                <td>{{ index.prof }}</td>
                <td>{{ index.birth }}</td>
                <td>
                    <router-link class="" :to="{name: 'edit', params: {workerId: index.id}}">Редактировать</router-link>
                    &nbsp;
                    <a href="#" @click="deleteWorker(index.id)">Удалить</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                index: [],
                errored: false,
                loading: true
            }
        },
        mounted() {
            this.loadWorkers()

        },
        methods: {
            loadWorkers(){
                axios.get('/api/workers')
                .then(response => {
                    this.index = response.data
                })
                .catch(error => {
                    this.errored = true
                })
                .finally(() => {
                    this.loading = false
                })
            },
            deleteWorker(id) {
                if(confirm('Действительно удалить?')){
                    axios   .post('/api/workers/delete/' + id, {
                        _method: 'post'
                    })
                    .then(response => {

                    })
                    .finally(() => {
                        this.loadWorkers()
                    })
                }

                return false
            }
        }
    }
</script>