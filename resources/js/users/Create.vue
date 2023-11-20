<template>
    <div class="">Создать</div>
    <div v-if="result.result">
        <div class="" style="background: #6dc26d">Вы успешно создали пользователя</div>
    </div>
    <form @submit.prevent="submitForm" method="POST">
        <div class="">Введите имя пользователя</div>
        <input type="text" name="name" v-model="user.name" style="margin-bottom: 10px;">

        <div class="">Введите email</div>
        <input type="text" name="email" v-model="user.email" style="margin-bottom: 10px;">

        <div class="">Пароль</div>
        <input type="text" name="password" v-model="user.password"  style="margin-bottom: 10px;">


        <div class="form-group">
            <div class="">Папка к которой относится пароль</div>
            <select class="form-control" name="folder_id" v-model="user.role">
                <option disabled >Выберите папку</option>

                <option value="user"> User</option>

                <option value="admin"> Admin</option>

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
            user:{},
            result: ''
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
                    console.error('An error occurred:', error);
                });
        }
    }
}
</script>

<style>

</style>
