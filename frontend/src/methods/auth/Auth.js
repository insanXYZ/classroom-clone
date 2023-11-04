import axios from "axios"

const env = import.meta.env

function register(data){
  return axios.post(env.VITE_URL_API+ "register", {
    name : data.name,
    password : data.password,
    email : data.email
  },
  {
    headers:{
      Accept: "application/json"
    }
  })
}

function login(data){
  return axios.post(env.VITE_URL_API+"login",{
    email : data.email,
    password : data.password
  },{
    headers: {
      Accept : "application/json"
    }
  })
}


export {register, login}
