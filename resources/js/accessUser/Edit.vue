<template>
    <div class="">Изменить доступы</div>
    <h3>Разрешает {{ userId.name }} доступ к данным</h3>

    <form  @submit.prevent="updatePassword">
        <div class="" style="display: flex;gap: 50px">

            <div class="">
                <h4 class="">Пользователи которым доступен этот пароль  id -
                    {{passwordId.id + '; Имя - ' + passwordId.username + '; Пароль - ' + passwordId.password}}</h4>
                {{checkedPassword}}
                <div class=""
                     v-for="(item, index) in user"
                     :key="index"

                     style="display: flex; gap: 25px;">
                    <input
                        type="checkbox"
                        :id="'checkbox' + index"
                        v-model="checkedPassword"
                        :value="item.id" >

                    <label :for="'checkbox' + index">id - {{item.id}}; Пользователь: {{item.name}} </label>

                </div>
            </div>
        </div>

        <button type="submit" >Редактировать</button>

    </form>
</template>

<script>
import axios from "axios";


export default {
    data() {
        return {
            //id пароля доступы к кот мы редактируем
            id : null,
            //таблица со всеми доступными этому пользователю Паролями из бд
            passwordAccess : {},

            user : [],
            //все пароли и папки
            passwordId : [],
            userId : [],

            //массивы с выбраннми чекбоксами доступными пользователю
            checkedPassword: [],

        };
    },
    mounted() {
        //сохраняем из get наш id для использования в отправке PUT
        this.id = this.$route.params.id;
        // переменная для get axios
        const id = this.$route.params.id;


        //принимем гет запрос от пользователя и сохраняем id пароля
        // ${id} эта цифра приходит от const id = this.$route.params.id;
        axios.get(`/api/passwords/${id}/access`)
            .then(response => {
                this.passwordId = response.data.passwordId;
                this.userId = response.data.userId;
                this.passwordAccess = response.data.passwordAccess;
                this.user = response.data.user;
                //заносим в массив id паролей и папок доступных из бд
                this.checkPasswordAccess(this.user, this.checkedPassword);
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
            axios.put('/api/passwords/' + this.id +'/access',{
                checkedPassword: this.checkedPassword,

            } )
                .then(response => {
                    // обработка успешного ответа
                    //обновляем наш массив с доступными этому пользователю данными
                    this.checkedPassword.length = 0;
                    this.checkedPassword = response.data.checkedPassword

                    console.log( this.checkedPassword);
                })
                .catch(error => {
                    // обработка ошибки
                    console.error('An error occurred while updating password:', error);
                });
        },
        //добавляем id  доступных Паролей в массив для далнейшей обработки на фронте
        checkPasswordAccess(access, checked) {
            //console.log(access[0].user_id, arr);
            access.forEach(item => {
                this.passwordAccess.forEach(value =>{
                    if (item.id === value.user_id && value.password_id === this.passwordId.id) {
                        checked.push(item.id); // Добавляем id элемента в массив checkedItems
                    }
                })

            })
        }

    }

}
</script>

<style>
</style>
