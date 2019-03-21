<template>
    <div>
        <p>{{ event.eventName }}</p>
        <p>{{ event.eventDescription }}</p>
    </div>
</template>

<script>
    export default {
        name : "Event",
        props : {
            
            event : {}
        },
        data(){
            return {
                description : "n'importe quoi"
            }
        }
    }
</script>

<style scoped>

</style>