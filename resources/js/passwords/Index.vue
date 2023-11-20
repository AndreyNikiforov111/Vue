<template>
    <div class="">Показать</div>
<!--    {{folder}}-->
    <form @submit.prevent="applyFilters" method="post">
        <input type="text" v-model="title" placeholder="title">
        <input type="text" v-model="username" placeholder="username">

        <div class="form-group">
            <div class="">Папка к которой относится пароль</div>
            <select class="form-control" name="folder_id" v-model="folder_id">
                <option value="0">Выберите папку</option>

                <option
                    v-for="item in folder"
                    :key="item.id"
                    :value="item.id"
                > {{ item.name }} {{item.id}} </option>

            </select>
        </div>
        <div class="form-group">
            <div class="">Пользователь создавший пароль</div>
            <select class="form-control" name="folder_id" v-model="user_id">
                <option value="0" >Выберите пользователя</option>

                <option
                    v-for="item in user"
                    :key="item.id"
                    :value="item.id"
                > {{ item.name }} {{item.id}} </option>

            </select>
        </div>
        <button type="submit">Применить фильтры</button>
    </form>
<!--    <li v-for="item in items" :key="item.id">{{ item }}</li>-->
    <table>
        <tr v-for="item in items.data" :key="item.id">
            <td><div>{{item.id}} - id пароля;  </div></td>
            <td><div>{{item.username}} - титульный; </div></td>
            <td><div>{{item.title}} - титульный; </div></td>
            <td><div>{{ item.user.name}} - Пользователь кот добавил этот пароль;  </div></td>
            <td><div>{{item.folder.name }} - Папка к кот относится этот пароль;  </div></td>
            <td> <a v-if="isRole(item.user_id)" :href="'/passwords/' + item.id"  class="btn btn-small btn-lg btn-primary">Edit</a></td>
            <td> <a v-if="isRoleUser(item.user_id)" :href="'/passwords/' + item.id + '/access'"  class="btn btn-small btn-lg btn-warning">Access</a></td>
            <td>
                <button  v-if="isRole(item.user_id)" @click="deletePost(item.id)" class="btn btn-small btn-danger">Delete</button>
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
            title: '',
            username: '',
            folder_id: null,
            user_id:null,
            user: [],
            folder: [],
            isUser: ''
        };
    },

    mounted() {
    },
    created() {
        axios.get('/api/passwords')
            .then(response => {
                this.redactor(response.data.password);
                this.isUser = response.data.isUser;
                this.user = response.data.user;
                this.folder = response.data.folder;

            })
            .catch(error => {
                console.error('An error occurred:', error);
            });
    },
    methods: {
        deletePost(id) {
            //console.log(id);
            axios.delete(`/api/passwords/${id}`)
                .then(response => {
                    window.location.reload();
                })
                .catch(error => {

                })
        },
        redactor(items){

            for ( let i = 0; i < items.length; i++){
                if (items[i].user == null){
                    items[i].user = {"name" : "Пользователь удален"}
                }
            }
            this.items = items
        },
        // редактировать через парорли может только user
        isRoleUser(id){
            if (id === this.isUser){
                return true
            }
            return false
        },
        //редактировать пароли и менять к нм доступы может только создавший их user
        isRole(id){
            console.log(this.isUser);
            if (this.isUser === true){
                return true
            }
            if (id === this.isUser){
                return true
            }
            return false
        },
        applyFilters(){
            console.log([
                this.title,
                this.username,
                this.folder_id,
                this.user_id])

        this.$router.push({
            path: '/passwords',
            query: {
                title: this.title,
                username : this.username,
                folder_id: this.folder_id,
                user_id: this.user_id
            }
        });
            axios.get('/api/passwords', {
                params: {
                    title: this.title,
                    username: this.username,
                    folder_id: this.folder_id,
                    user_id: this.user_id,
                }
            })
                .then(response => {
                    this.redactor(response.data.password);
                })
                .catch(error => {
                    console.error('Произошла ошибка:', error);
                });

    }
},
}
</script>

<style>

</style>
