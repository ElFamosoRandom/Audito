<template>
	<div class="content">
		<h1>
			Ajout d'un évènement
		</h1>
  	<label for="name">Nom de l'évènement : </label>
  	<input id="name" v-model="event.eventName" type="text" name="name">
    <br/>
  	<label for="eventType">Type de l'évènement : </label>
  	<select v-model="event.eventType" name="eventType" id="eventType">
  		<option v-for="eventType in eventTypes" :value="eventType.id" :key="eventType.id">{{eventType.eventTypeName}}</option>
  	</select>
    <br/>
  	<label for="genre">Genre de l'évènement : </label>
  	<input id="genre" v-model="event.eventGenre" type="text" name="genre" placeholder="">
    <br/>
  	<label for="description">Description de l'évènement : </label>
  	<textarea id="description" v-model="event.eventDescription" name="description"></textarea>
    <br/>
  	<label for="date">Date planifée : </label>
  	<input id="date" v-model="event.dateEvent" type="date" name="date">
    <br/>
  	<label for="time">Heure planifée : </label>
  	<input id="time" v-model="event.time" type="time" name="time">
    <br/>
    <label for="photo">Affiche : </label>
    <input id="photo" v-on:change="onFileSelected" type="file" name="photo">
    <br/>
  	<div id="submit" @click="submitForm">Planifier cet évènement</div>
	</div>
</template>

<script>
	import axios from "axios";

	export default {
    name : "AddEvent",
    props : {
    	
    },
    data() {
        return {
            eventTypes : [],
            event : {
            	eventName : "",
            	eventType : "",
            	eventDescription : "",
            	eventGenre : "",
            	dateEvent : "", 
              time : "",
              date : "",
              photoId : {}
            }
        }
    },
    methods : {
      onFileSelected(event){
        this.event.photoId.url = event.target.files[0];
      },
			loadEventTypes(){
          axios.get("/api/event_types").then((res) =>{
              this.eventTypes = res.data;
          });
      },
      submitForm(){
        const fd = new FormData();
        this.event.photoId.url = document.getElementById('photo').value;
        fd.append('image', this.event.photoId.url);
        this.event.date=this.event.dateEvent+" "+this.event.time;
        this.event.eventType="/api/event_types/"+this.event.eventType;
      	axios.post("/api/events", this.event).then((res) => {
      		console.log(res);
      	});
        
      }
    },
    mounted() {
      this.loadEventTypes();
    }
  }
</script>

<style scoped lang="scss">
	.content {
		color:black;
		#submit {
			cursor:pointer;
		}
	}
</style>