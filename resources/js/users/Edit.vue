<template>
    <div class="">Добавить</div>
    <div v-if="result">
        <div class="" style="background: #6dc26d">Вы успешно изменили пользователя</div>
    </div>
    <form  @submit.prevent="updatePassword">

        <div class="">Введите имя </div>
        <input type="text" name="name" v-model="user.name"  class="input">

        <div class="">Введите email</div>
        <input type="text" name="email" v-model="user.email" class="input">

        <div class="">Пароль</div>
        <input type="text" name="password" v-model="user.password" class="input">
        <button @click.prevent="generatePassword">Сгенерировать пароль</button>

        <div class="form-group">
            <div class="">Роль пользователя </div>
            <select class="form-control" name="folder_id" v-model="user.role">

                <option value="user" > User</option>

                <option value="admin"> Admin</option>

            </select>
        </div>
        <div v-if="errors" style="background: #ba7979">
            <ul>
                <li v-for="error in errors" :key="error">{{ error }}</li>
            </ul>
        </div>
        <button type="submit" >Редактировать</button>

    </form>

</template>

<script>
import axios from "axios";

    export default {
        data() {
            return {
                id : null,
                user : [],
                errors: null,
                result: '',
            };
        },
        mounted() {
            //сохраняем из get наш id для использования в отправке PUT
            this.id = this.$route.params.id;
            // переменная для get axios
            const id = this.$route.params.id;


            //принимем гет запрос от пользователя и сохраняем id пароля
            // ${id} эта цифра приходит от const id = this.$route.params.id;
            axios.get(`/api/users/${id}`)
                .then(response => {
                    //console.log(response.data.user);
                    this.user = response.data.user;
                    this.result = response.data.result
                    //console.log(this.user);

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
            //отправляем через метод пут данные на бэк
            updatePassword() {
                axios.put('/api/users/' + this.id,  this.user )
                    .then(response => {
                        // обработка успешного ответа
                        this.result = response.data.result
                        console.log('Password updated successfully', response.data);
                        //this.$validatedData = response.data.$validatedData;
                    })
                    .catch(error => {
                        // обработка ошибки\
                        if (error.response.status === 422) {
                            // Если получен статус 422 (неправильные данные), обрабатываем ошибки валидации из Laravel
                            this.errors = Object.values(error.response.data.errors).flat();
                        }
                        console.error('An error occurred while updating password:', error);
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
    .input{
        margin-bottom: 10px;
    }
</style>
