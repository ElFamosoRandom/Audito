
<template>
    <div class="daycard">
        
        <div class="evtCard">
        
        <div class="leftSide">
            <img :src="url" class="cardImage"/> 
            <router-link class="btn" :to="'/detail/' + event.id">Accèder au détail</router-link>
        </div>
        <div class="rightSide">
            <h1 class="evtTitle">Titre : {{ event.eventName }}</h1>
            <p class="evtDescription">{{event.eventDescription}}</p>
        </div>
        
    </div>
        
        
        
    </div>
</template>


<script>
    export default {
        name : "DayCard",
        props : {
            event : {},
            url : "",
            idevent : ""
        },
        data(){
            return {
                description : "n'importe quoi"
            }
        },
        methods : 
        {
            getTrueUrl(){
                this.url = "/images/" + this.event.photoId.url
            },
            getElementId(){
                this.idevent = this.event.id
            }
            
        },
        mounted(){
            this.getTrueUrl();
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