<template>

	<div>
        <div v-for="event in events" :event="event" :key="event.id">
            {{event.id}}, {{event.eventName}}
            <button @click="deleteEvent(event.id)" :data-id="event.id">Supprimer</button>
        </div>
</div>
</template>
<script>
    import axios from "axios";

	export default {
        name : "DeleteEvent",
        props : {

        },
        data(){
            return {
                events : [],
                event : {
                    id : ""
                }
            }
        },
        methods : {
            loadEvents(){
                axios.get("/api/events").then((res) =>{
                    this.events = res.data
                });
            },
            deleteEvent(id){
                axios.delete("/api/events/"+id).then((res) =>{
                    for(var index in this.events){
                        if(this.events[index].id == id){
                            this.events.splice(index, 1)
                        }
                    }
                })
            }	   
        },
        mounted() {
            this.loadEvents();
    	}
    }
</script>

<style scoped lang="scss">
	
</style>