<template >
  <AuthTemplate :loading="loading" @form="store">
    <span v-if="error" class="text-center bg-blue-400 font-semibold p-1 text-white">email dan password salah</span>
    <Input @input="item => this.email = item" for="email" type="text">Email</Input>
    <Input @input="item => this.password = item " for="password" min="8" type="password">Password</Input>
    <button class="bg-green-500 p-1 border-[5px] border-yellow-500 text-white font-semibold">Login</button>
    <hr>
    <div class="flex w-full text-blue-600 font-semibold justify-end items-center">
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
      error: false,
      loading : false,
    }
  },
  // watch:{
  //   loading(){
  //     return this.loading
  //   }
  // },
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
      this.loading = true,

      login(data).then(response=> {
        this.loading = false
        Cookies.set("token", response.data.token)
        this.$router.push("/")
      }).catch(error => {
        this.loading = false
        this.showError()
      })
    }
  }

}
</script>
<style >
  
</style>