<template>
    <div class="">Создать</div>
    <div v-if="result.result">
        <div class="" style="background: #6dc26d">Вы успешно создали папку</div>
    </div>
    <form @submit.prevent="submitForm" method="POST">
        <div class="">Введите имя папки</div>
        <input type="text" name="name" v-model="folder.name" style="margin-bottom: 10px;">
        <br>
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
            result:''

        };
    },
    created() {
        axios.get('/api/folders/create')
            .then(response => {

            })
            .catch(error => {
                console.error('An error occurred:', error);
            });
    },
    methods: {
        submitForm() {
            console.log(this.folder);
            axios.post('/api/folders',  this.folder )
                .then(response => {
                    this.result = response.data
                    console.log('Password updated successfully', this.result);
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
