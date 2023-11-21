<template>
    <div class="">Создать</div>
    <table>
        <tr v-for="item in items" :key="item.id">
            <td><div>{{item.id}} - id пользователя;  </div></td>
            <td><div>{{item.name}} - Имя пользователя;  </div></td>
            <td><div>{{item.email }} - Email пользователя;  </div></td>
            <td><div>{{item.role }} - Роль пользователя;  </div></td>

            <td><a v-if="isUser" :href="'/users/' + item.id"  class="btn btn-small btn-lg btn-primary">Edit</a></td>
            <td><a v-if="isUser" :href="'/users/' + item.id + '/access'"  class="btn btn-small btn-lg btn-warning">Access</a></td>
            <td>
                <button v-if="isUser" @click="deletePost(item.id)" class="btn btn-small btn-danger">Delete</button>
            </td>
        </tr>
    </table>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            items: [],
            isUser: ''
        };
    },
    mounted() {
    },
    created() {
        axios.get('/api/users')
            .then(response => {

                this.items = response.data.user;
                this.isUser = response.data.isUser;
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
        deletePost(id) {
            console.log(id);
            axios.delete(`/api/users/${id}`)
                .then(response => {
                    console.log(response.data);
                    //this.items = response.data;
                    window.location.reload();
                })
                .catch(error => {
                })
        }
    },

}
</script>

<style>

</style>
