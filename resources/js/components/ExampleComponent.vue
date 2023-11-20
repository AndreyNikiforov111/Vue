<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>
                    <div class="card-body">
                        <router-link to="/passwords">Показать пароли</router-link>
                    </div>
                    <div class="card-body">
                        <router-link to="/passwords/create">Создать пароль</router-link>
                    </div>
                    <div class="card-body">
                        <router-link to="/folders/create">Создать папку</router-link>
                    </div>
                    <div class="card-body">
                        <router-link to="/users">Показать пользователей</router-link>
                    </div>
                    <div class="card-body">
                        <router-link to="/users/create">Создать пользователя</router-link>
                    </div>
                    <div class="card-body">
                        <router-link to="/login">Login</router-link>
                    </div>
                    <div class="card-body">
                        <router-link to="/register">Register</router-link>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <router-view/>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            /*logout(){
                axios.post('/logout').then( res =>{
                    this.$router.push({name:'user.login'})
                })
            }*/
        }
    }
</script>
