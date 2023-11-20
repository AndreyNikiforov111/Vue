<template>
    <div class="">Добавить</div>
    <form  @submit.preven="updatePassword">

        <div class="">Поле редактирования имени пароля</div>
        <input type="text" name="username" v-model="password.username" style="margin-bottom: 10px;">

        <div class="">Введите имя заголовок</div>
        <input type="text" name="title" v-model=" password.title" style="margin-bottom: 10px;">

        <div class="">Пароль</div>
        <input type="text" name="password" v-model=" password.password " style="margin-bottom: 10px;">
        <div class="">Проект</div>
        <input type="text" name="project" v-model=" password.project " style="margin-bottom: 10px;">

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
                });
        },
        methods: {
            //отправляем через метод пут данные на бэк
            updatePassword() {
               // console.log( this.password.folder_id);

                axios.put('/api/passwords/' + this.id,  this.password )
                    .then(response => {
                        // обработка успешного ответа
                        console.log('Password updated successfully', response.data);
                        //this.$validatedData = response.data.$validatedData;
                    })
                    .catch(error => {
                        // обработка ошибки
                        console.error('An error occurred while updating password:', error);
                    });
            }
        }

    }
</script>

<style>

</style>
