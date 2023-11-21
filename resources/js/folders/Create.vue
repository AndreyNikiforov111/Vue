<template>
    <div class="">Создать</div>
    <div v-if="result.result">
        <div class="" style="background: #6dc26d">Вы успешно создали папку</div>
    </div>
    <form @submit.prevent="submitForm" method="POST">
        <div class="">Введите имя папки</div>
        <input type="text" name="name" v-model="folder.name" class="input">
        <br>
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
            folder: {},
            result:'',
            errors: null

        };
    },
    created() {
        axios.get('/api/folders/create')
            .then(response => {

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
            axios.post('/api/folders',  this.folder )
                .then(response => {
                    this.result = response.data
                    console.log('Password updated successfully', this.result);
               })
                .catch(error => {
                    if (error.response.status === 422) {
                        // Если получен статус 422 (неправильные данные), обрабатываем ошибки валидации из Laravel
                        this.errors = Object.values(error.response.data.errors).flat();
                    }
                    console.error('An error occurred:', error);
                });
        }
    }
}
</script>

<style>

</style>
