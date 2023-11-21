<template>
    <div class="">Добавить</div>
    <div v-if="result">
        <div class="" style="background: #6dc26d">Вы успешно создали пароль</div>
    </div>
    <form  @submit.prevent="updatePassword">

        <div class="">Поле редактирования имени пароля</div>
        <input type="text" name="username" v-model="password.username" class="input">

        <div class="">Введите имя заголовок</div>
        <input type="text" name="title" v-model=" password.title" class="input">

        <div class="">Пароль</div>
        <input type="text" name="password" v-model=" password.password " class="input">
        <button @click.prevent="generatePassword">Сгенерировать пароль</button>

        <div class="">Проект</div>
        <input type="text" name="project" v-model=" password.project " class="input">

        <div class="form-group">
            <div class="">Папка к которой относится пароль</div>
            <select class="form-control" name="folder_id" v-model="password.folder_id">
                <option disabled >Выберите папку</option>

                <option
                    v-for="item in folder"
                    :key="item.id"
                    :value="item.id"
                    :v-model="password.folder_id"
                > {{ item.name }} {{item.id}} </option>

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
                password : {},
                folder : [],
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
            axios.get(`/api/passwords/${id}`)
                .then(response => {
                    this.password = response.data.password;
                    this.folder = response.data.folder;
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
               // console.log( this.password.folder_id);

                axios.put('/api/passwords/' + this.id,  this.password )
                    .then(response => {
                        // обработка успешного ответа
                        this.result = response.data.result
                        console.log('Password updated successfully', response.data);
                        //this.$validatedData = response.data.$validatedData;
                    })
                    .catch(error => {
                        // обработка ошибки
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
                this.password.password = password; // Установка сгенерированного пароля в переменную данных
            }
        }

    }
</script>

<style>

</style>
