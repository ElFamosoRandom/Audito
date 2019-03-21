<template>
    <div class="page">
        <div class="homeHeader">
            <div class="Title">AUDITO</div>
            <div class="plsScroll">Scroll down</div>
        </div>
        <div class="homeContent">
            <h1 class="thisWeek">CETTE SEMAINE ...</h1>
            <h2 id="Date"></h2>
            <div class="eventCardContainer">
                
                <eventCard v-for="event in events" :event="event" :key="event.id">
            
                </eventCard>     
                
            </div>
        </div>
          
          <div>
            <router-link class="navItem navItemalign-right" to="/detail"> detail test</router-link>
        </div>
    </div>
    

</template>



<script>

    import axios from "axios";
    import EventCard from "./EventCard"

    export default {
        name : "HomePage",
        components: {EventCard},
        data(){
            return {
                events : [],
            }
        },
        methods : {
            loadEvent(){
                

                let datesite = document.getElementById("Date");
            
                let curr = new Date(); 

                var dd = curr.getDate();
                var mm = curr.getMonth()+1; 
                var yyyy = curr.getFullYear();

                if(dd<10) {
                    dd = '0'+dd
                } 

                if(mm<10) {
                    mm = '0'+mm
                } 

                var week = []

                for (let i = 1; i <= 7; i++) {
                  let first = curr.getDate() - curr.getDay() + i 
                  let day = new Date(curr.setDate(first)).toISOString().slice(0, 10)
                  week.push(day)
                }

                axios.get("/api/events").then((res) =>{

                    let arrayData = res.data
                    
                    let arrayLenght = Object.keys(arrayData).length;
                    let firstDate = week.shift();
                    var explodeFirstDate = firstDate.split('-');
                    let lastDate = week[week.length-1]
                    var explodeLastDate = lastDate.split('-');
                    //console.log(explodeFirstDate)
                    //console.log(explodeLastDate)
                    //console.log(dd)
                    var explodeFirstDateParsed = [];
                    var explodeLastDateParsed = [];
                    for (let i = 0; i < 3; i++) {
                        //console.log(res.data[i].date)
                        explodeFirstDateParsed[i] = parseInt(explodeFirstDate[i]);
                    }

                    for (let i = 0; i < 3; i++) {
                        //console.log(res.data[i].date)
                        explodeLastDateParsed[i] = parseInt(explodeLastDate[i]);
                    }
                    //console.log(explodeFirstDateParsed)
                    //console.log(explodeLastDateParsed)
                    
                    for (let i = 0; i<arrayLenght;i++){
                        //console.log(arrayData[i]);
                        let eventData = arrayData[i].date.slice(0, 10)
                        //console.log(eventData)
                        let explodeEventData = eventData.split('-');
                        //console.log(explodeEventData);
                        var explodeEventDataParsed = [];
                        for(let i = 0; i < 3; i++){
                            explodeEventDataParsed[i] = parseInt(explodeEventData[i])
                        }
                        console.log(explodeEventDataParsed)
                        if(explodeFirstDateParsed[2] <= explodeEventDataParsed[2] && explodeLastDateParsed[2] >= explodeEventDataParsed[2]){
                            if(explodeFirstDateParsed[1] <= explodeEventDataParsed[1] && explodeLastDateParsed[1] >= explodeEventDataParsed[1]){
                                if(explodeFirstDateParsed[0] <= explodeEventDataParsed[0] && explodeLastDateParsed[0] >= explodeEventDataParsed[0]){
                                    this.events.push(arrayData[i]);
                                }
                            }
                        }
                        
                    }

                    //this.events = res.data
                    console.log(this.events)
                })

                datesite.innerHTML = "aujourd'hui, nous sommes le : " + dd + '/' + mm + '/' + yyyy;
            }
        },
        mounted(){
            this.loadEvent();
            
        }
    }
    
</script>

<style scoped lang="scss">
    
    .homeHeader{
       height: 100vh;
       padding-top: 45vh;
       .Title{
            transform: translateY(-50%);
            margin: auto;
            text-align: center;
            font-size: 5vw;
            color: $active-text-color;
            background-color: $dark;
            padding: 2vw;
            width : 30%;
            box-shadow: 10px 10px 40px rgba(0, 0, 0, 0.521);
            border-radius: 100px;
            
       }
       .plsScroll{
           transform: translateY(-50%);
            margin: 22vh auto;
            text-align: center;
            font-size: 2vw;
            color: $dark;
            /*background-image: linear-gradient(to right top, #d81f27, #ca1532, #bb113b, #aa1340, #981744);
            background-attachment: fixed;
            
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;*/
       }
    }
    .page
    {
        
        .thisWeek{
            color:$dark;
            margin-left:10vw;
            margin-bottom: 2vh;
            font-size: 3vw;
        }
        .eventCardContainer
        {
            
            margin:auto;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: center;
            
        }
    }
    

</style>