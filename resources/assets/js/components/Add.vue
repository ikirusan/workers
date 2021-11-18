<template>
    <div>
        <h1 v-if="workerId === undefined" class="mb-5">Добавление сотрудника</h1>
        <h1 v-else class="mb-5">Редактирование сотрудника</h1>
        <div v-if="errored" class="alert alert-danger">Ошибка загрузки данных!</div>
        <div v-if="success" class="alert alert-success">Данные сохранены!</div>
        <div v-if="loading" class="text-center">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div v-if="!loading">
        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" name="name" id="name" v-model="name" class="form-control" :class="{'is-invalid': this.$v.name.$error}" v-model.trim="$v.name.$model" placeholder="Укажите имя">
            <div class="invalid-feedback" v-if="!$v.name.required">
                Укажите имя сотрудника!
            </div>
        </div>
        <div class="form-group">
            <label for="birth">Дата рождения</label>
            <input type="date" name="birth" id="birth" v-model="birth" class="form-control" :class="{'is-invalid': this.$v.birth.$error}" v-model.trim="$v.birth.$model">
            <div class="invalid-feedback" v-if="!$v.birth.required">
                Укажите дату рождения сотрудника!
            </div>
        </div>
        <div class="form-group">
            <label for="prof">Должность</label>
            <input type="text" name="prof" id="prof" v-model="prof" class="form-control" :class="{'is-invalid': this.$v.prof.$error}" v-model.trim="$v.prof.$model" placeholder="Укажите должность">
            <div class="invalid-feedback" v-if="!$v.prof.required">
                Укажите должность сотрудника!
            </div>
        </div>
        <button type="button" class="btn btn-success" @click="saveWorker">
            Сохранить
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" v-if="loaded"></span>
        </button>
        <router-link class="btn btn-link" :to="{name: 'index'}">Вернуться</router-link>
        </div>
    </div>
</template>

<script>
    import { required, maxLength } from 'vuelidate/lib/validators'
    export default {
        props: [
            'workerId'
        ],
        data(){
            return{
                worker: [],
                name: '',
                birth: '',
                prof: '',
                errored: false,
                loading: true,
                loaded: false,
                success: false
            }
        },
        methods: {
            saveWorker(){
                this.$v.$touch()
                if(this.$v.$invalid){
                    return false;
                }

                this.loaded = true
                axios.post('/api/workers/edit/' + this.workerId, {
                    _method: 'post',
                    name: this.name,
                    birth: this.birth,
                    prof: this.prof
                })

                .then(response => {
                    this.loaded = false

                    if(this.workerId != undefined){
                        this.success = true

                    }else{
                        this.$router.push({ name: 'index' })
                    }
                })
            }
        },
        mounted() {
            axios.get('/api/workers/edit/' + this.workerId)
            .then(response => {
                this.name = response.data.name
                this.birth = response.data.birth
                this.prof = response.data.prof
            })
            .catch(error => {
                this.errored = true
            })
            .finally(() => {
                this.loading = false
            })
        },
        validations: {
            name: {
                required
            },
            birth: {
                required
            },
            prof: {
                required
            }
        }

    }
</script>