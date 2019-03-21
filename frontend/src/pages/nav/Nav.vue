<template>

    <div>
        <router-link :to="{ name : 'login' }">lien vers login</router-link>
        <br>
        <router-link :to="{ name : 'programmation' }">lien vers ianis</router-link>
    </div>
</template>

<script>
    import { mapActions } from "vuex";

    export default {
        name : "HomePage",
        methods : {
            ...mapActions(["loadUser"])
        },
        mounted(){
            this.loadUser()
        }
    }
  
</script>

<style scoped lang="scss">


</style>