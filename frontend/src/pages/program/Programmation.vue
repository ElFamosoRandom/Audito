<template>
    <div>
        <h1 class="configTitle">Programmation disponible dans notre salle</h1>
        
        <div class="homeContent">
            <div id="dropdown" class="FormFieldContainer">
                <select id="select" @change="getEvent()" v-model="actualweek" class="formFields">
                    <option v-for="date in datetable" :key="date.i" v-bind:value="date.id" :selected="actualweek" class="opt">{{"Semaine du "+date.FirstDay+" au "+date.LastDay}}</option>
                </select>   
            </div>
            <div class="eventCardContainer">
                
                <article class="FormFieldContainer progItem" v-for="event in events" :event="event" :key="event.id">
                    {{event.eventName}}
                    <router-link class="formFields align-right" :to="'/detail/' + event.id">Accèder au détail</router-link>
                </article>
                
                     
                
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
    

    #nullEvent{
        width: 50vh;
        font-size: 2.5vw;
        transform: translateY(-50%);
        margin: 20vh auto 0 auto;
        text-align: center;
    }

    /*#select{
        font-size: 1.1vw;
        background-color : grey;
    }*/
    #dropdown{
        margin:  5vh auto 5vh auto;
        width: 20vw;
    }
    .opt{
        font-size: 1.1vw;
        //background-color: orange;
    }
    .eventCardContainer{
        display: flex;
        justify-content: center;
        flex-direction: column;
        width: 42vw;
        margin: auto;
    }
    .progItem{
        margin: 1vh auto 1vh auto;
        width : 40vw !important;
        display: flex;
        flex-direction: row;
        line-height: 5vh;
        justify-content: end;
        .align-right{
            margin-left: 25vw;
        }
    }
</style>