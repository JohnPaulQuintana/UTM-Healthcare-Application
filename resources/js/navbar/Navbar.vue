<template>
    <!-- {{ token_id }} -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><b>UTM-Healthcare Application</b></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
                <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
                <!-- Unauthenticated -->
                <div class="d-flex" v-if="$store.getters.getToken == 0 || $store.getters.getToken == undefined">
                    <!-- <router-view></router-view> -->
                    
                    <router-link :to="{name : 'Login'}" class="nav-link me-4"><span>Login</span></router-link>
                    <router-link :to="{name : 'Register'}" class="nav-link me-4"><span>Register</span></router-link>
                    <!-- <router-link :to="{name : 'User'}" class="nav-link me-4"><span>User {{ $store.getters.getToken }}</span></router-link> -->
                </div>
                    
                 <!-- authorized Doctor -->
                 
                <div class="user" v-else-if="$store.getters.Token != 0 && $store.getters.getTokenSpeciality === 'Doctor' || $store.getters.getTokenSpeciality === 'doctor'">
                    
                    <ul class="navbar-nav me-5 mb-2 mb-lg-0">
                        <a class="nav-link position-relative p-2">
                            <router-link :to="{name: 'Request'}">
                                <font-awesome-icon icon="fa-solid fa-bell" />
                                <span class="text-white position-absolute translate-middle badge rounded-pill bg-danger" v-if="(count != 0)">
                                    {{ count }}
                                </span>
                                
                            </router-link></a>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ $store.getters.getTokenName }}
                        <!-- <font-awesome-icon icon="fa-solid fa-power-off" /> -->
                        </a>
                        
                        <form @submit.prevent="logout">
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <button type="submit" class="dropdown-item" >Logout</button>
                                <button class="dropdown-item">
                                    <!-- params: { id : token_id } -->
                                    <router-link :to="{name : 'Schedule'}" class="nav-link me-4"><span>Schedule</span></router-link>
                                </button>
                                <button class="dropdown-item">
                                    <router-link :to="{name : 'Request'}" class="nav-link me-4"><span>Request</span></router-link>
                                </button>
                                <button class="dropdown-item">
                                    <router-link :to="{name : 'Profile'}" class="nav-link me-4"><span>Profile</span></router-link>
                                </button>
                                <button class="dropdown-item">
                                    <router-link :to="{name : 'EmergencyRequest'}" class="nav-link me-4"><span>Emergency-Request</span></router-link>
                                </button>
                                
                               
                            </div>
                        </form>
                    </li>
                    </ul>
                </div>
                <!-- authorized Student -->
                <div class="user" v-else>
                    <ul class="navbar-nav me-5 mb-2 mb-lg-0">
                        <a class="nav-link"><router-link :to="{name: 'Request'}"><span class="text-warning" v-if="(count != 0)">{{ count }}</span><font-awesome-icon icon="fa-solid fa-bell" /></router-link></a>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ $store.getters.getTokenName }}
                        <!-- <font-awesome-icon icon="fa-solid fa-power-off" /> -->
                        </a>
                        
                        <form @submit.prevent="logout">
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <button type="submit" class="dropdown-item" >
                                    Logout
                                </button>
                                <button class="dropdown-item">
                                    <router-link :to="{name : 'Student'}" class="nav-link me-4"><span>Home</span></router-link>
                                </button>
                                <button class="dropdown-item">
                                    <router-link :to="{name : 'Emergency'}" class="nav-link me-4"><span>Emergency Call</span></router-link>
                                </button>
                                <button class="dropdown-item">
                                    <router-link :to="{name : 'RequestStatus'}" class="nav-link me-4"><span>Request Status</span></router-link>
                                </button>
                                <button class="dropdown-item">
                                    <router-link :to="{name : 'Profile'}" class="nav-link me-4"><span>Profile</span></router-link>
                                </button>
                                
                               
                            </div>
                        </form>
                    </li>
                    </ul>
                </div>
                </div>
            </div>
        </nav>
        
        <RouterView v-slot="{ Component, route }">
            <transition
                name="fade" 
                mode="out-in">
                <div :key="route.name">
                    <component :is="Component"/>
                </div>
            </transition>
        </RouterView>
</template>
<script>
    import getLogout from "../composables/getLogout.js";
   0 // import $ from 'jquery'
    // import { useRouter, useRoute } from 'vue-router'
    // import { useStore } from 'vuex';
    import store from "../store/index.js";
    export default {
        setup () {
            // to access function composable
            const {logout} = getLogout()  
            return {logout}
        },

        data: function(){
           return {
                token_id : store.getters.getTokenId,
                clearTimer: '',
                count : 0
           }
        },
        mounted() {
            
            // console.log('mounted')
            this.notif()
            // refresh
            //  this.clearTimer=setInterval(this.notif,5000)
        },
        methods: {
            notif(){
                // let store = useStore()
                // const router = useRouter()
                // console.log(JSON.parse(localStorage.getItem("token")))
                let token = JSON.parse(localStorage.getItem("token"))
                if(token == null){
                    token = 0;
                }
                // console.log(token.bearerToken)
                const headers = {
                    'Accept': 'application/vnd.api+json',
                    'Content-Type': 'application/vnd.api+json',
                    'Authorization': 'Bearer ' + token.bearerToken
                    }
                   axios.get('/api/bookschedule',{headers})
                    .then((res)=>{
                    console.log(res)
                    this.studentRequests = res.data.data
                    this.count = this.studentRequests.length
                    console.log(this.count)
                    })

                    .catch((err)=>{
                    console.log(err)
                    if(err.response.status == 401 ){
                       clearInterval(this.clearTimer)
                  //  console.log('dwahdjawd');  
                    }
                })
            }
        }
    }
</script>

<style scoped>
    /* ::-webkit-scrollbar{
        display: none;
    } */
    #app{
        font-family: Avenir, Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing:grayscale;
        text-align: center;
        color: #2c3e50;
        margin-top: 60px;
        }
    a.router-link-active{
        border-bottom:2px solid #5543ca ;
        }

        /* style for fade */
    .fade-enter-from,
    .fade-leave-to{
        opacity: 0;
        /* transform: translateY(160px); */
        }

    .fade-enter-active,
    .fade-leave-active{
            transition: opacity 0.5s ease-out;
        }
</style>