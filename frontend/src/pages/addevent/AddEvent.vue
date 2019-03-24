<template>
	<div class="content">
        <section>
           
            <div class="theatreForm">
                <p class="FormFieldContainer">
                    <input class="formFields" id="name" v-model="event.eventName" type="text" name="name" placeholder="Nom de l'évènement">
                </p>
                <p class="FormFieldContainer">
                    <select class="formFields" v-model="event.eventType" name="eventType" id="eventType">
                        <option v-for="eventType in eventTypes" :value="eventType.id" :key="eventType.id">{{eventType.eventTypeName}}</option>
                    </select>
                </p>
                <p class="FormFieldContainer">
                    <input class="formFields" id="genre" v-model="event.eventGenre" type="text" name="genre" placeholder="Genre de l'évènement ">
                </p>
                <p class="FormFieldContainer">
                    <textarea class="formFields" id="description" v-model="event.eventDescription" name="description" placeholder="Description de l'évènement "></textarea>
                </p>
                <p class="FormFieldContainer">
                    <label for="date">Date planifée : </label>
                    <input class="formFields" id="date" v-model="event.dateEvent" type="date" name="date">
                </p>
                <p class="FormFieldContainer">
                    <label for="time">Heure planifée : </label>
                    <input class="formFields" id="time" v-model="event.time" type="time" name="time">
                </p>
                <p class="FormFieldContainer formFieldBtn" >
                    <button class="formFields "  id="submit" @click="submitForm">Planifier cet évènement</button>
                </p>            
            </div>
            <section class="places theatreConfig">
                <h1 class="configTitle">CONFIGURATION DE LA SALLE</h1>
                <p class="subTitle">selectionnez les places à enlever</p>
                <article class="gridCatC gridCat">
                    <table class="theatre catB1 catB"></table>
                    <table class="theatre catC"></table>
                    <table class="theatre catB2 catB"></table>
                </article>
                <article class="gridCatA gridCat">  
                    <table class="theatre catA"></table>
                </article>
            </section>
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
        if (thisButton.classList.contains("selectedAdd")) {
            thisButton.classList.remove("selectedAdd");
            for( let i = 0; i < this.seats.length; i++){ 
                if ( this.seats[i].id == thisButton.id) {
                    this.seats.splice(i, 1); 
                }
            }
        }
        else
        {
            thisButton.classList.add("selectedAdd");
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
        this.getplaces(20,5,".catA",8,10)
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
    ::placeholder {
        color: rgb(142, 199, 180)!important;
        
    }
    .FormFieldContainer{
        width:15vw;
        height: 5vh;
        background-color: rgb(38, 138, 129);
        color:rgb(83, 182, 174);
        padding: 0.5vw;
        margin: 0.5vw;
        display: flex;
        align-content: center;
        box-shadow: 5px 5px 10px rgba(31, 82, 79, 0.849);

    }
    .formFields{
        width: 100%;
        background-color:rgb(38, 138, 129);
        border:none;
        color: rgb(157, 238, 211)!important;
        transition: 0.2s ease;

    }
    .theatreForm{
        margin-top: 18vh; 
        margin-left: 17vw; 
        padding-left:1vw; 
        display: flex;
        justify-content: center;
        width: 18vw;
        flex-direction: column;
        position: absolute;
        //border : dashed rgb(38, 138, 129) 1px; 
    }
    .theatreConfig{
     margin-left: 20vw;    
     
    }
    .formFieldBtn{
        transition: 0.2s ease;
    }
    .formFieldBtn:hover{
        background-color:rgb(72, 190, 181);
        .formFields{
        background-color:rgb(72, 190, 181);

        }
    }
    .configTitle{
        margin-top: 20vh;
        text-align: center;
        color: rgb(38, 138, 129);
    }
    .subTitle{
        text-align: center;
        color: rgb(185, 184, 184);
    }
    
</style>