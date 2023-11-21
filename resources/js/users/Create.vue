<template>
    <div class="">Создать</div>
    <div v-if="result.result">
        <div class="" style="background: #6dc26d">Вы успешно создали пользователя</div>
    </div>
    <form @submit.prevent="submitForm" method="POST">
        <div class="">Введите имя пользователя</div>
        <input type="text" name="name" v-model="user.name" class="input">

        <div class="">Введите email</div>
        <input type="text" name="email" v-model="user.email" class="input">

        <div class="">Пароль</div>
        <input type="text" name="password" v-model="user.password"  class="input">
        <button @click.prevent="generatePassword">Сгенерировать пароль</button>

        <div class="form-group">
            <div class="">Роль пользователя</div>
            <select class="form-control" name="folder_id" v-model="user.role">

                <option value="user"> User</option>

                <option value="admin"> Admin</option>

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
            user:{},
            result: '',
            errors: null
        };
    },
    created() {
        axios.get('/api/users/create')
            .then(response => {
                //console.log(response.data)
            })
            .catch(error => {
                if(error.response.status === 401){
                    this.$router.push('/login');
                }
                console.error('An error occurred:', error);
                return Promise.reject(error);

            });

    },
    methods: {
        submitForm() {
            console.log(this.user);
            axios.post('/api/users',  this.user )
                .then(response => {
                    this.result = response.data
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
            this.user.password = password; // Установка сгенерированного пароля в переменную данных
        }

    }
}
</script>

<style>

</style>
