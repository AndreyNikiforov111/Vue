<template>
    <div class="">Создать</div>
    <div v-if="result">
        <div class="" style="background: #6dc26d">Вы успешно создали пароль</div>
    </div>
    <form @submit.prevent="submitForm" method="POST">
        <div class="">Введите имя пароля</div>
        <input type="text" name="username" v-model="password.username" style="margin-bottom: 10px;">

        <div class="">Введите имя заголовок</div>
        <input type="text" name="title" v-model="password.title" style="margin-bottom: 10px;">

        <div class="">Пароль</div>
        <input type="text" name="password" v-model="password.password"  style="margin-bottom: 10px;">
        <div class="">Проект</div>
        <input type="text" name="project" v-model="password.project"  style="margin-bottom: 10px;">

        <div class="form-group">
            <div class="">Папка к которой относится пароль</div>
            <select class="form-control" name="folder_id" v-model="password.folder_id">
                <option disabled >Выберите папку</option>

                <option
                    v-for="item in items"
                    :key="item.id"
                    :value="item.id"
                > {{ item.name }} {{item.id}} </option>

            </select>
        </div>
        <button type="submit">Создать</button>

    </form>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            items: [],
            password:{},
            result: ''
        };
    },
    created() {
        axios.get('/api/passwords/create')
            .then(response => {
                this.items = response.data.folder;
            })
            .catch(error => {
                console.error('An error occurred:', error);
            });

    },
    methods: {
        submitForm() {
            console.log(this.password);
            axios.post('/api/passwords',  this.password )
                .then(response => {
                    this.result = response.data.result
                    console.log('Password updated successfully', response.data);
               })
                .catch(error => {
                    console.error('An error occurred:', error);
                });
        }
    }
}
</script>

<style>

</style>
