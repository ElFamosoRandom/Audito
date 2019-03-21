<template>
    <div>
        <h1>Image ianis</h1>
        
        <div class="homeContent">
            <div id="dropdown">

            </div>
            <div class="eventCardContainer">
                
                <dayCard v-for="event in events" :event="event" :key="event.id">
            
                </dayCard>     
                
            </div>
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
            }
        },
        methods : {
            
            loadEvent(){
                

                axios.get("/api/events").then((res) =>{

                    this.events = res.data;
                    

                })

            },
            

            selectFunction(){

                

                var select = document.createElement('select');
                select.id = "select";
                

                var datetable = [];
                for(var i=1; i<=52; i++){
                    var weektable = [];
                    var FirstDay = moment().day("Monday").isoWeek(i)
                    var LastDay = moment().day("Sunday").isoWeek(i);

                    
                
                    weektable.push(moment(FirstDay).format('DD/MM/YYYY'))
                    weektable.push(moment(LastDay).format('DD/MM/YYYY'))
                    datetable.push(weektable);
                    var option = document.createElement('option');
                    option.innerHTML = "semaine du " + weektable[0] + " au " + weektable[1]
                    option.value = i;
                    select.appendChild(option);
                }
                var selectdiv = document.getElementById("dropdown")
                selectdiv.appendChild(select);
            },
            
            testfunction(){

                
                var selectdiv = document.getElementById("dropdown")
                var select = document.getElementById("select")
                selectdiv.appendChild(select);

                select.addEventListener("change",function(e){

                    
                    var weekArray = [1,2,3,4,5,6,7]
                    var weekLenght = Object.keys(weekArray).length;
                    var weekIntArray = []
                    var optionvalue = parseInt(e.target.value)
                        
                        
                        
                    //console.log(weekLenght) 
                    for(let i = 0; i< weekLenght; i++){
                        var dayArray = []

                         var FirstDay = moment().day(weekArray[i]).isoWeek(optionvalue);
                            
                        dayArray.push(parseInt(moment(FirstDay).format('DD')))
                        dayArray.push(parseInt(moment(FirstDay).format('MM')))
                        dayArray.push(parseInt(moment(FirstDay).format('YYYY')))

                        weekIntArray.push(dayArray)
                        //console.log(weekIntArray);

                            
            
                    }
                    //console.log(weekIntArray)

                    axios.get("/api/events").then((res) =>{

                        //this.events = res.data

                        var arrayData = res.data
                        var arrayLenght = Object.keys(arrayData).length;

                        var elementget = []
                        for(let i=0; i<= arrayLenght-1; i++){
                            var eventDate = arrayData[i].date.slice(0, 10)
                            var explodeDate = eventDate.split('-');
                            var parsedDay = parseInt(explodeDate[2])
                            var parsedMonth = parseInt(explodeDate[1])
                            var parsedYear = parseInt(explodeDate[0])
                                
                                

                             if(weekIntArray[0][0] <= parsedDay && weekIntArray[6][0] >= parsedDay){
                                if(weekIntArray[0][1] <= parsedMonth && weekIntArray[6][1] >= parsedMonth){
                                    if(weekIntArray[0][2] <= parsedYear && weekIntArray[6][2] >= parsedYear){
                                        //this.events.push(arrayData[i]);
                                        //console.log(arrayData[i])
                                        elementget.push(arrayData[i]);
                                        console.log(elementget)
                                        
                                    }
                                }
                            }
                        } 
                    }) 
                });
            }       
        },
        mounted(){
            //this.loadEvent();
            this.selectFunction();
            this.testfunction();
            

        }
    }

</script>


<style scoped lang="scss">
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
            }
        }

        
        
        

        
    }
</style>