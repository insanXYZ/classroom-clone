<template >
  <Login @form="store" >
    <Input @input="item => this.name = item" inputFor="name" type="text" min="3">Username</Input>
    <span v-if="errorName" class="font-light italic text-sm text-red-600">{{ errorName }}</span>
    <Input @input="item => this.email = item" inputFor="email" type="email">Email</Input>
    <span v-if="errorEmail" class="font-light italic text-sm text-red-600">{{ errorEmail }}</span>
    <Input @input="item => this.password = item" inputFor="password" type="password" min="8">Password</Input>
    <span v-if="errorPassword" class="font-light italic text-sm text-red-600">{{ errorPassword }}</span>

    <button class="bg-green-500 p-1 border-[5px] border-yellow-500 text-white font-semibold">Register</button>
    <hr>
    <div class="flex w-full text-blue-600 font-semibold justify-between items-center">
      <router-link to="Login">Login</router-link>
    </div>
  </Login>
</template>
<script>
import Login from "../components/templates/AuthTemplate.vue"
import Input from "../components/Auth/Input.vue"
import { register } from "../methods/auth/Auth";

export default {
  data(){
    return{
      name : "",
      errorName : "",
      email :"",
      password : "",
      errorEmail: "",
      errorPassword: ""
    }
  },
  components: {
    Login,
    Input
  },
  methods: {
    store(){

      const data = {
        name : this.name,
        email : this.email,
        password : this.password,
      }

      register(data).then(Response => {
        this.$router.push("/login")
      }).catch(error => {
        let message = error.response.data.message
        Object.keys(message).forEach(key => {
          const messages = message[key];
          messages.forEach(message => {
            if(key == "name"){
              this.errorName = message
            }

            if(key == "password"){
              this.password = message
            }

            if(key == "email"){
              this.password = message
            }
          });
});
      })
    }
  }
}
</script>
<style >
  
</style>