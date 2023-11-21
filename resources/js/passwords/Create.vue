<template>
    <div class="">Создать</div>
    <div v-if="result">
        <div class="" style="background: #6dc26d">Вы успешно создали пароль</div>
    </div>
    <form @submit.prevent="submitForm" method="POST">
        <div class="">Введите имя пароля</div>
        <input type="text" name="username" v-model="password.username" class="input">

        <div class="">Введите имя заголовок</div>
        <input type="text" name="title" v-model="password.title" class="input">

        <div class="">Пароль</div>
        <input type="text" name="password" v-model="password.password"  class="input">
        <button @click.prevent="generatePassword">Сгенерировать пароль</button>

        <div class="">Проект</div>
        <input type="text" name="project" v-model="password.project"  class="input">

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
        <div v-if="errors" style="background: #ba7979">
            <ul>
                <li v-for="error in errors" :key="error">{{ error }}</li>
            </ul>
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
            result: '',
            errors: null
        };
    },
    created() {
        axios.get('/api/passwords/create')
            .then(response => {
                this.items = response.data.folder;
            })
            .catch(error => {
                console.error('An error occurred:', error);
                if(error.response.status === 401){
                    this.$router.push('/login');
                }
                console.error('An error occurred:', error);
                return Promise.reject(error);
            });

    },
    methods: {
        submitForm() {
            axios.post('/api/passwords',  this.password )
                .then(response => {
                    this.result = response.data.result
                    console.log('Password updated successfully', response.data);
               })
                .catch(error => {
                    if (error.response.status === 422) {
                        // Если получен статус 422 (неправильные данные), обрабатываем ошибки валидации из Laravel
                        this.errors = Object.values(error.response.data.errors).flat();
                    }
                    console.error('An error occurred:', error);
                });
        },
        generatePassword() {
            const length = 8; // Длина генерируемого пароля
            const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; // Набор символов для генерации пароля
            let password = "";
            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * charset.length);
                password += charset[randomIndex];
            }
            this.password.password = password; // Установка сгенерированного пароля в переменную данных
        }

    }
}
</script>

<style>

</style>
