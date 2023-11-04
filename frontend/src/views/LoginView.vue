<template >
  <AuthTemplate @form="store">
    <span v-if="error" class="text-center bg-blue-400 font-semibold p-1 text-white">email dan password salah</span>
    <Input @input="item => this.email = item" for="email" type="text">Email</Input>
    <Input @input="item => this.password = item " for="password" min="8" type="password">Password</Input>
    <button class="bg-green-500 p-1 border-[5px] border-yellow-500 text-white font-semibold">Login</button>
    <hr>
    <div class="flex w-full text-blue-600 font-semibold justify-between items-center">
      <router-link to="#">Forgot Password?</router-link>
      <router-link to="register">Register</router-link>
    </div>
  </AuthTemplate>
</template>
<script>
import AuthTemplate from "../components/templates/AuthTemplate.vue"
import {login} from "../methods/auth/Auth"
import Input from "../components/Auth/Input.vue"
import Cookies from "js-cookie"

export default {
  data(){
    return {
      email: "",
      password : "",
      error: false
    }
  },
  components: {
    AuthTemplate,
    Input
  },
  methods: {
    showError(){
      this.error = true,

      setTimeout(() => {
        this.error = false
      }, 3000);
    },
    store(){

      let data = {
        email : this.email,
        password : this.password
      }

      login(data).then(response=> {
        Cookies.set("TJ", response.data.token)
        this.$router.push("/")
      }).catch(error => {
        this.showError()
      })
    }
  }

}
</script>
<style >
  
</style>