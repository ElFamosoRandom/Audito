<template>
    <div>
        <h1>Login</h1>
        <user v-for="user in users" :user="user" :key="user.id">{{user.userLastName}}</user>

        adresse e-mail : <input v-model="user.email">
        Mot de passe : <input v-model="user.password" :type="passwordFieldType">
        <button type="password" @click="switchVisibility">Afficher le mot de passe</button>
        <button @click="register" type="submit">Se connecter</button>
           
    </div>
</template>

<script>
    import axios from "axios";
    import User from "./User";

    export default {
        name : "LoginPage",
        components: {User},
        data(){
            return {
                users : [],
                user : {
                    email : "",
                    password : ""
                },
                passwordFieldType: 'password'
            }       
        },
        methods : {
            loadUsers(){
                axios.get("/api/users").then((res) =>{
                    this.users = res.data
                })
            },
            switchVisibility(){
                this.passwordFieldType = this.passwordFieldType === 'password' ? 'text' : 'password'
            },
            register(){
                console.log(this.user.email, this.user.password)
                axios.post("/api/users", this.user).then((res) => {
                    console.log(res);
                })
            },
            login: function () {
                const { username, password } = this
                this.$store.dispatch(AUTH_REQUEST, { username, password }).then(() => {
                    this.$router.push('/')
                })
            },
            handleSubmit(e){
                e.preventDefault()
                if (this.password.length > 0) {
                    axios.post('/api/users', {
                        email: this.email,
                        password: this.password
                    })
                    .then(response => {
                        let is_admin = response.data.user.is_admin
                        localStorage.setItem('user',JSON.stringify(response.data.user))
                        localStorage.setItem('jwt',response.data.token)
                        
                        if (localStorage.getItem('jwt') != null){
                            this.$emit('loggedIn')
                            if(this.$route.params.nextUrl != null){
                                this.$router.push(this.$route.params.nextUrl)
                            }
                            else {
                                if(is_admin== 1){
                                    this.$router.push('admin')
                                }
                                else {
                                    this.$router.push('dashboard')
                                }
                            }
                        }
                    })
                    .catch(function (error) {
                        console.error(error.response);
                    });
                }
            }
        },
        mounted(){
            this.loadUsers();
        }
    }
</script>

<style scoped lang="scss">

    h1 {
        color : $text-color;
    }
</style>