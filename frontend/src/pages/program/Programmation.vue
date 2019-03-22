<template>
    <div>
        <h1>Programmation disponible dans notre salle</h1>
        
        <div class="homeContent">
            <div id="dropdown">
                <select id="select" @change="getEvent()" v-model="actualweek">
                    <option v-for="date in datetable" :key="date.i" v-bind:value="date.id" :selected="actualweek" class="opt">{{"Semaine du "+date.FirstDay+" au "+date.LastDay}}</option>
                </select>   
            </div>
            <div class="eventCardContainer">
                
                <dayCard v-for="event in events" :event="event" :key="event.id">
            
                </dayCard>     
                
            </div>

            <h2 id="nullEvent">Pas d'évènement cette semaine !</h2>
        </div>
        
    </div>
    
</template>


<script>
    

    import axios from "axios";
    import DayCard from "./DayCard"
    import moment from 'moment'

    export default {
        name : "Programmation",
        
        components: {DayCard},
        
        data(){
            
            return {
                events : [],
                datetable: [],
                key : [],
                actualweek : moment().week()
            }

        },
        methods : {
            
            loadEvent(){
                

                axios.get("/api/events").then((res) =>{

                    this.events = res.data;
                    

                })

            },
            

            selectFunction(){

                

                /*var select = document.createElement('select');
                select.id = "select";*/
                
                for(var i=1; i<=53; i++){
                    var weektable = {
                        id:'',
                        FirstDay:'',
                        LastDay:'',
                    };
                    var FirstDay = moment().day("Monday").isoWeek(i)
                    var LastDay = moment().day("Sunday").isoWeek(i);
                    

                    
                    weektable.id = i;
                    weektable.FirstDay = (moment(FirstDay).format('DD/MM/YYYY'))
                    weektable.LastDay = (moment(LastDay).format('DD/MM/YYYY'))
                    this.datetable.push(weektable);

                    /*var option = document.createElement('option');
                    option.innerHTML = "semaine du " + weektable[0] + " au " + weektable[1]
                    option.value = i;
                    select.appendChild(option);*/
                }
                /*var selectdiv = document.getElementById("dropdown")
                selectdiv.appendChild(select);*/
            },

            getEvent(){

                console.log(this.actualweek)
                
                let weekArray = [1,2,3,4,5,6,7]
                let weekLenght = Object.keys(weekArray).length;
                let weekIntArray = []
                //console.log(this.key)
                let optionvalue = this.actualweek
                //console.log(optionvalue);
                
                //console.log(weekLenght) 
                for(let i = 0; i< weekLenght; i++){
                    let dayArray = []

                    let FirstDay = moment().day(weekArray[i]).isoWeek(optionvalue);
                        
                    dayArray.push(parseInt(moment(FirstDay).format('DD')))
                    dayArray.push(parseInt(moment(FirstDay).format('MM')))
                    dayArray.push(parseInt(moment(FirstDay).format('YYYY')))

                    weekIntArray.push(dayArray)
                    //console.log(weekIntArray);
                }
                //console.log(weekIntArray)

                axios.get("/api/events").then((res) =>{


                        let arrayData = res.data
                        let arrayLenght = Object.keys(arrayData).length;
                        //console.log(arrayData);
                        var elementget = []
                        for(let i=0; i<= arrayLenght-1; i++){
                            let eventDate = arrayData[i].date.slice(0, 10)
                            let explodeDate = eventDate.split('-');
                            let parsedDay = parseInt(explodeDate[2])
                            let parsedMonth = parseInt(explodeDate[1])
                            let parsedYear = parseInt(explodeDate[0])

                            //console.log(parsedDay);
                            //console.log(weekIntArray[1][0]);
                            //console.log(weekIntArray[6][0])
                                
                                

                             if(weekIntArray[0][0] <= parsedDay && weekIntArray[6][0] >= parsedDay){
                                if(weekIntArray[0][1] <= parsedMonth && weekIntArray[6][1] >= parsedMonth){
                                    if(weekIntArray[0][2] <= parsedYear && weekIntArray[6][2] >= parsedYear){
                                        //this.events.push(arrayData[i]);
                                        //console.log(arrayData[i])
                                        //this.events =  arrayData[i];
                                        elementget.push(arrayData[i]);
                                       
                                    }
                                }
                            }
                        }
                        this.events = elementget;

                        if(this.events.length == 0){
                            console.log("yarien");
                            let message = document.getElementById("nullEvent")
                            message.innerHTML = "Pas d'évènement cette semaine !"
                        }
                        else{
                            let message = document.getElementById("nullEvent")
                            message.innerHTML = ""
                            console.log(this.events);
                        }
                    })
            },   
             

     
        },
        mounted(){
            //this.loadEvent();
            this.selectFunction();
            this.getEvent();
        }
    }

</script>


<style lang="scss">
    .evtCard{
        flex: 0 1;
        display: flex;
        height: 70vh;
        min-width: 60vw;
        margin: 0.5vw;
        background-color: $dark;
        box-shadow: 5px 5px 10px rgba(5, 5, 5, 0.521);
        flex-direction: row;
        border-radius: 10px;
        
        .leftSide{
            display: flex;
            flex-direction: column;
            justify-content: center;
            flex: 0 0;


            .cardImage{
            height: 50vh;
            margin:  0 0 0vh 2vw;
            flex: 0 0;
            }

            .btn{
                margin:  1vh 0 0 2vw;
                height : 8vh;
                background-color: #353535;
                border: none;
            }
        }
        .rightSide{

            display: flex;
            flex-direction: column;
            margin:  5vh;
            flex: 1 1;
            background-color: rgb(24, 24, 24);
            color:$active-text-color;

            .evtTitle{
            flex: 0 1;
            color: $active-text-color;
            margin: 5vh;
            font-size: 1.2em;
            }

            .evtDescription{
                
                margin: 5vh;
                overflow-x: hidden;
            }
        }
    }

    #nullEvent{
        width: 50vh;
        font-size: 2.5vw;
        transform: translateY(-50%);
        margin: 50vh auto 0 auto;
        text-align: center;
    }

    #select{
        font-size: 1.1vw;
        background-color : grey;
    }

    .opt{
        font-size: 1.1vw;
        background-color: orange;
    }
</style>