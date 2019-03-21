<template>
    <div>
        <p>{{ user.userEmail }}</p>
        <p>{{ user.id }}</p>
    </div>
</template>

<script>
    export default {
        name : "User",
        props : {
            title : {
                type : String,
                default : "ah"
            },
            user : {}
        },
        data(){
            return {
                description : "fdgsdgs"
            }
        }
    }
</script>

<style scoped>

</style>