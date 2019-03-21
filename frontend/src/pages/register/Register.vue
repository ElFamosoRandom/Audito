<template>
	<div class="content">
		<h1>
			Inscription
		</h1>
  		<div class="flex-row">
  			<div>
  				<label for="lastName">Nom</label>
  			</div>
  			<div>
  				<input id="lastName" v-model="user.userLastName" type="text" name="lastName">
  			</div>
  		</div>
  		<div class="flex-row">
  			<div>
  				<label for="firstName">Prénom : </label>
  			</div>
  			<div>
  				<input id="firstName" v-model="user.userFirstName" type="text" name="firstName">
  			</div>
  		</div>
  		<div class="flex-row">
  			<div>
  				<label for="date">Date de naissance : </label>
  			</div>
  			<div>
  				<input id="date" v-model="user.userBirthDate" type="date" name="date">
  			</div>
  		</div>
  		<div class="flex-row">
  			<div>
  				<label for="email">email : </label>
  			</div>
  			<div>
  				<input id="email" v-model="user.userEmail" type="email" name="email">
  			</div>
  		</div>
  		<div class="flex-row">
  			<div>
  				<label for="password">mot de passe : </label>
  			</div>
  			<div>
  				<input id="password" v-model="user.userPassword" type="password" name="password">
  			</div>
  		</div>
  		<div class="flex-row">
  			<div>
  				<label for="city">ville : </label>
  			</div>
  			<div>
  				<input id="city" v-model="user.userCity" type="text" name="city">
  			</div>
  		</div>
  		<div class="flex-row">
  			<div>
  				<label for="postcode">code postal : </label>
  			</div>
  			<div>
  				<input id="postcode" v-model="user.userPostCode" type="text" name="postcode">
  			</div>
  		</div>
  		<div class="flex-row">
  			<div>
  				<label for="rue">rue : </label>
  			</div>
  			<div>
  				<input id="rue" v-model="user.userStreet" type="text" name="rue">
  			</div>
  		</div>
  		<div class="flex-row">
  			<div>
  				<label for="phonenumber">numéro de téléphone : </label>
  			</div>
  			<div>
  				<input id="phonenumber" v-model="user.userPhoneNumber" type="text" name="phonenumber">
  			</div>
  		</div>
  		<button id="submit" @click="submitForm">S'inscrire</button>
	</div>
</template>

<script>
	import axios from "axios";

	export default {
    name : "Register",
    props : {
    	
    },
    data() {
        return {
            user : {
            	userLastName : "",
            	userFirstName : "",
            	userBirthDate : "",
            	userEmail : "",
            	userPassword : "",
            	userCity : "",
            	userPostCode : "",
            	userStreet : "",
            	userPhoneNumber : "",
            	isAdmin : false
            }
        }
    },
    methods : {
      submitForm(){
      	axios.post("/api/users", this.user).then((res) => {
      		console.log(res);
      	})
      }
    },
    mounted() {
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