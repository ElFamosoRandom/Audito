<template>
    <div>
        <h1>Detail</h1>
        <div>
            
            <p>{{events.eventName}}</p>
            <p>{{events.eventDescription}}</p>
            <p>{{events.eventGenre}}</p>
            <div>
            <router-link class="navItem navItemalign-right" v-bind:to="'/reservation/'+this.$route.params.id"> Je réserve</router-link>
            </div>
            
        </div>
        
        
    </div>
</template>

<script>
    import axios from "axios";
    import Event from "./Event"

    export default {
        name : "DetailPage",
        components: {Event},
        data(){
            return {
                events : [],
            }
        },
        methods : {
            loadEvent(){
                axios.get("/api/events/" + this.$route.params.id).then((res) =>{
                    this.events = res.data
                    
                })
            }
        },
        mounted(){
            this.loadEvent();
        }
    }
</script>

<style scoped lang="scss">

    h1 {
        color : $text-color;
    }
</style>