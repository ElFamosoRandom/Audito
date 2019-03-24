<template>
    <div>
        <h1 class="reservationTitle">Reservation</h1>
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
        <section class="placesList">
            <div class="seat" v-for="seat in seats" :key="seat.id" :id="seat.id">
                <P class="place placeListElement">place {{seat.id}} catégorie {{seat.cat}}</P>
                <select class="tarif placeListElement" name="tarif" id="">
                    <option value="1">Adulte</option>
                    <option value="2">Réduit Adulte</option>
                    <option value="3">Matin Adulte</option>
                    <option value="4">Jeune</option>
                    <option value="5">Matin jeune</option>
                </select>
            </div>
        </section>
        <button class="validate" v-on:click="reserve()"> RESERVER !</button>

        <!--insert 450 places en base
            <button class="validate" v-on:click="insertAll()"> inserer places</button>-->
        

        <!--<button class="seat" v-for="seat in seats" :key="seat.id" :id="seat.id" v-on:click="select($event)"> </button>
        -->
    </div> 
        
       
    
</template>

<script>
	import axios from "axios";
    
    export default {
        name : "Reservation",
        props : {
            
            
        },
       data(){
            return {
                seats : [],
                insertSeats : [],
                dbSeats : {},
                reservedSeats : [],
                categories :{"A" : 1, "B" : 2,"C" : 3},
            }
        },
        methods : 
        {
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
                        if (!this.reservedSeats.includes(thisSeatId)) {
                            thisCase.classList.add("seat")
                            let TheSeatCat = "/api/categories/"+this.categories[thisCat]
                            
                            let TheSeat = {category : TheSeatCat, placeRow: thisSeatrow ,placeColumn : trueId}
                            //console.log(TheSeat)
                            this.insertSeats.push(TheSeat)
                            thisCase.addEventListener("click",(e) => {
                            this.select(e.target)
                            
                        }); 
                        }
                        else{
                            thisCase.classList.add("disabledSeat")
                        }
                        
                    }
                }
                //console.log(seats)
           },
           insertAll(){
               /*for(let i = 0;i<this.insertSeats.length;i++){
                   axios.post("/api/places",this.insertSeats[i])

               }
               console.log(this.insertSeats.length + " places insérées")*/
           },
           getDatabasePlaces(){
               console.log("oui?")
               axios.get("/api/places").then((res) =>{
                   console.log(res.data)
                   for (let i = 0; i < res.data.length; i++) {
                       let thisDbPlaces = res.data[i];
                       let Placekey = thisDbPlaces.placeRow + "-" + thisDbPlaces.placeColumn;
                       if (this.reservedSeats.includes(thisDbPlaces.id)) {
                           this.dbSeats[Placekey] = "unaviable"
                       }else{
                           this.dbSeats[Placekey] = thisDbPlaces;

                       }
                       
                   }
                   console.log(this.dbSeats)
               })
           },
           reserve(){
               let thisEvent = "/api/events/"+this.$route.params.id;
               let reservTab = this.seats;
               reservTab.forEach(e =>{
                   let placeId = "/api/places/"+this.dbSeats[e.id].id;
                   let Reservation = {userId : "/api/users/1",eventId : thisEvent, placeId : placeId};
                   axios.post("/api/reservations",Reservation)
               })
           },
           getReservations(){
               axios.get("/api/reservations").then((res) =>{
                    for (let i = 0; i < res.data.length; i++) {
                        if (res.data.eventId == this.$route.params.id) {
                            this.reservedSeats.push(res.data.placeId)
                            
                        }
                       
                       
                   }
               })
           }
           
        },
        mounted(){
            this.getReservations()
            this.getDatabasePlaces()
            this.getplaces(5,10,".catB1",1,0)
            this.getplaces(25,10,".catC",6,0)
            this.getplaces(5,10,".catB2",31,0)
            this.getplaces(20,5,".catA",8,10)
    }
        }
</script>

<style lang="scss">
.reservationTitle{
    text-align: center;
    line-height:20vh;
    font-size: 5vh;
    color: $dark;
}
.places{
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.gridCatC{
   
    transform : translateY(-50%);
    margin: 20vh auto 0vh auto;
}
.gridCat{
    display: flex;
    flex-direction: row;
    flex:1 1;

}
.gridCatA{
    transform : translateY(-120%);
    margin: auto;
    
}
.catB{
    padding-top:5vh;
}
.theatre{
    flex:1 1;

    margin:0.5vw;
    .selected{
        background-color: rgb(74, 193, 197)!important;
    }
    .selected:hover{
        background-color: rgb(67, 124, 126)!important;
    }
    .selectedAdd{
        background-color: rgb(233, 233, 233)!important;

    }
    .placesContainer{
    padding: 20vw;
    }
    tr{  
        display: flex;
        flex-direction: row;
        .seat{
            width: 2vw;
            height: 2vw;
            border: none;
            margin: 0.2vh;
            background-color: rgb(197, 197, 197);
            
        }
        .disabledSeat{
            width: 2vw;
            height: 2vw;
            border: none;
            margin: 0.2vh;
            background-color: rgb(228, 228, 228);
            
        }
        .seatAdd{
            width: 1vw;
            height: 1vw;
            border: none;
            margin: 0.2vh;
            background-color: rgb(197, 197, 197);
        }
        .seatAdd:hover{
            background-color: rgb(90, 90, 90);
        }
        .seat:hover{
            background-color: rgb(90, 90, 90);
        }
        
    }
        
}
.placesList{
    margin-top: -20vh; 

    display: flex;
    flex-direction: column;
    justify-content: center;
    
    
    .seat{
        display: flex;
        flex-direction: row;
        flex-wrap: warp;
        margin-top :4vh;
        margin-left:auto;
        margin-right: auto;
        border-top: 2px solid #39c3e6;
        width:70vw;
        height: 2vh;
        padding-top: 3vh;
        
       
        .placeListElement{
            margin-left:1vw;
            
        }
        .tarif{
            border:  rgb(197, 197, 197);
            border-radius: 19px;
            height: 2vw;
            
        }
        

    }
}
.validate{
    width: 10vw;
    height: 5vh;
    margin: 5vh auto 5vh 45vw;
    border : none;
    background-color: #39c3e6;
}
        

    
</style>