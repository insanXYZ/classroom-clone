import axios from "axios"
import Cookies from "js-cookie"
import { jwtDecode } from "jwt-decode"
import router from "../../router/index"

let axiosInstance = axios.create({
  baseURL: import.meta.env.VITE_URL_API
})

axiosInstance.interceptors.request.use(
  async config => {
    config.headers["Accept"] = "application/json"
    let decodeJwt = jwtDecode(Cookies.get("token"))
    if(decodeJwt.exp < Date.now() / 1000){
      let refreshToken = await axiosInstance.get("/refresh")
      let newToken = refreshToken.data.token
      Cookies.set("token", newToken)
    }
    config.headers["Authorization"] = "Bearer " + Cookies.get("token")
    return config
  },
  error => {
    return Promise.reject(error)
  }
)

axiosInstance.interceptors.response.use(
  response => {
    return response
  },
  async error => {
    let originalRequest = error.config

    if(error.response.status == 401 && error.response.data.message == "Expired" && !originalRequest.retry){
      originalRequest.retry = true

      let refreshToken = await axiosInstance.get("/refresh")

      let newToken = refreshToken.data.token
      Cookies.set("token", newToken)

      return axiosInstance(originalRequest)
    }

    if(error.response.status == 401 && error.response.data.message == "Invalid" || "Error"){
      Cookies.remove("token")
      return router.push("/login")
    }

    return Promise.reject(error)
  }
)

function createClass(data){
  return axiosInstance.post("class",{
    name : data.name,
    section : data.section,
    subject : data.subject,
    room : data.room
  })
}

function getMenu(){
  return axiosInstance.get("class/menu")
}

function getClasses(){
  return axiosInstance.get("class");
}

function getClass(id){
  return axiosInstance.get("class/"+id)
}

function me(){
  return axiosInstance.get("me")
}

function inputAnnouncement(data){
  return axiosInstance.post("class/announcement",data)
}

function deleteFile(id){
  return axiosInstance.delete("file/"+id)
}

function updateAnnouncement(data, id){
  return axiosInstance.post("class/announcement/"+id,data)
}

function joinClass(data){
  return axiosInstance.post("class?join=true",data);
}

function logout(){
  return axiosInstance.get("logout")
}

export {createClass, getMenu,getClasses,getClass,me,inputAnnouncement,deleteFile,updateAnnouncement,joinClass,logout}