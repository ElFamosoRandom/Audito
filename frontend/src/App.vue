<template>
    <div id="app">
        <div id="nav">
            <router-link class="navItem navItemalign-right" to="/login"> Login</router-link>
            <router-link class="navItem navItemalign-right" to="/programmation"> Programmation</router-link>
            <router-link class="navItem navItemalign-right" to="/tarif"> Tarifs</router-link>
            <router-link class="navItem navItemalign-right" to="/addevent"> Ajout évènement</router-link>
            <router-link class="navItem navItemalign-right" to="/deleteevent">Supprimer un évenement</router-link>
            <router-link class="navItem navTitle" to="/">Home</router-link>
        </div>
        <section class="mainContent">
            <router-view/>

        </section>

        <footer>
            &copy; killian et ses amis
        </footer>
    </div>


    
</template>

<style lang="scss">

    @import "./style/index";
    h1 {
        color : $text-color;
    }

#nav{
    background-color: $dark;
    height: 5vh;
    position: sticky;
    top: 0px;
    z-index: 2;
    .navItem{
  
    color: $non-active-text-color;
    text-decoration: none;
    line-height: 5vh;
    
    margin-right:2vw;
    transition: 0.2s ease;     
    }
    .navItemalign-right{
        float: right;
    }

    .navTitle{
        float: left;
        margin-left:1vw;
    }

    .navItem:hover{
  
    color: $active-text-color;
    
    }


}
.mainContent{
    min-height: 100vh;
    width: 100vw;
    background-color: #e7e7e7

    
}
footer{
   
    height: 5vh;
    background-color: $dark;
    color: $active-text-color;
    position: relative;
    z-index: 2;
    line-height: 5vh;
}


</style>
