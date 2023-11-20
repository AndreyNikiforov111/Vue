<template>
    <div class="">Добавить</div>

    <form  @submit.preven="updatePassword">

        <div class="">Введите имя </div>
        <input type="text" name="name" v-model="user.name" style="margin-bottom: 10px;">

        <div class="">Введите email</div>
        <input type="text" name="email" v-model="user.email" style="margin-bottom: 10px;">

        <div class="">Пароль</div>
        <input type="text" name="password" v-model="user.password"  style="margin-bottom: 10px;">

        <div class="form-group">
            <div class="">Роль пользователя </div>
            <select class="form-control" name="folder_id" v-model="user.role">
                <option disabled >Выберите папку</option>

                <option value="user" > User</option>

                <option value="admin"> Admin</option>

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
                user : [],


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
                    this.user = response.data;
                    console.log(this.user);

                })
                .catch(error => {
                    console.error('An error occurred:', error);
                });
        },
        methods: {
            //отправляем через метод пут данные на бэк
            updatePassword() {
                console.log( this.id);

                axios.put('/api/users/' + this.id,  this.user )
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
