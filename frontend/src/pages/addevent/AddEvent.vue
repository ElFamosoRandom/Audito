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
        <br/>
        <div id="submit" @click="submitForm">Planifier cet évènement</div>

        <section class="places">
        <article class="gridCatC gridCat">
            <table class="theatre catB1 catB"></table>
            <table class="theatre catC"></table>
            <table class="theatre catB2 catB"></table>
        </article>
        <article class="gridCatA gridCat">  
                <table class="theatre catA"></table>
        </article>
        </section>
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
                date : ""
            },
            seats : [],
        }
    },
    methods : {
	loadEventTypes(){
          axios.get("/api/event_types").then((res) =>{
              this.eventTypes = res.data;
              console.log(this.eventTypes);
          });
    },
    submitForm(){
        /*axios.post("/api/photos", this.photo).then((res) => {
            console.log(res);
        });*/
        this.event.date=this.event.dateEvent+""+this.event.time;
        this.event.eventType="/api/event_types/"+this.event.eventType;
      	axios.post("/api/events", this.event).then((res) => {
            console.log(res);
      	});
    },
    select(thisButton){
        //console.log(selectedBtn)
        if (thisButton.classList.contains("selected")) {
            thisButton.classList.remove("selected");
            for( let i = 0; i < this.seats.length; i++){ 
                if ( this.seats[i].id == thisButton.id) {
                    this.seats.splice(i, 1); 
                }
            }
        }
        else
        {
            thisButton.classList.add("selected");
            let thisId = thisButton.id
            let thisCat = thisButton.getAttribute("cat")
            let idTab = thisId.split("-")
            this.seats.push({id : thisId, row : idTab[0], collum : idTab[1], cat:thisCat })
            console.log(this.seats)
        }
    },
    getplaces(col,row,table,startCol,startrow){
        let thisTable = document.querySelector(table);
        
        for (let i = 0; i < row; i++) {
            let thisLine = document.createElement("tr")
            thisTable.appendChild(thisLine)
            
            for (let j = 0; j < col; j++) {
                let thisCase = document.createElement("td")
                thisCase.classList.add("seatAdd")
                thisLine.appendChild(thisCase)

                let trueId = j + startCol
                let thisSeatrow = String.fromCharCode(i + 65 +startrow)
                let thisCat = "B"
                if (trueId<=5 || trueId >= 31) 
                {
                    thisCat = "C"
                } else if (i + startrow >= 10) {
                    thisCat = "A"
                }
                let thisSeatId = thisSeatrow+"-"+trueId
                thisCase.setAttribute("id",thisSeatId)
                thisCase.setAttribute("cat",thisCat)
                thisCase.addEventListener("click",(e) => {
                    this.select(e.target)
                    
                }); 
            }
        }
        //console.log(seats)
    },
    },
    mounted() {
        this.loadEventTypes();
        this.getplaces(5,10,".catB1",1,0)
        this.getplaces(25,10,".catC",6,0)
        this.getplaces(5,10,".catB2",31,0)
        this.getplaces(10,5,".catA",13,10)
    }
  }
</script>

<style lang="scss">
	.content {
		color:black;
		#submit {
			cursor:pointer;
		}
	}
</style>