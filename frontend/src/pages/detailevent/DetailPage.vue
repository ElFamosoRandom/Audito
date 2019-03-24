<template>
    <div>
        
        <div class="detailContainer">
            
            <article class="eventInfos">
                <p class="FormFieldContainer"><span class="formFields">{{events.eventName}}</span></p>
                <p class="FormFieldContainer"><span class="formFields">{{events.eventGenre}}</span></p>
                <div>
                    <router-link class="FormFieldContainer formFieldBtn" v-bind:to="'/reservation/'+this.$route.params.id"><span  class="formFields"> Je réserve</span></router-link>
                </div>
                
            </article>
            <article class="eventDescription">
                <p>{{events.eventDescription}}</p>
            </article>
           
            
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

<style lang="scss">
    
    .detailContainer{
        
        width : 46vw;
        margin: 10vh auto 0 auto;
        .eventInfos{
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
            line-height: 5vh;
            text-align: center;
            
        }
        .eventDescription{
            width: 96%;min-height: 50vh;
            background-color: rgb(38, 138, 129);
            color:rgb(83, 182, 174);
            padding: 0.5vw;
            margin: 0.5vw;
            display: flex;
            align-content: center;
            box-shadow: 5px 5px 10px rgba(31, 82, 79, 0.849);
            
        }
    }   
    
</style>