<template>
   <div class="container">
    <h4 class="text-secondary">Hello there, <span>{{ $store.getters.getTokenName }}</span><font-awesome-icon icon="fa-solid fa-hand-holding-heart" class="text-danger" /></h4><br/>
        <div class="row">
            <h1 class="text-secondary">If you have appointment settled. Give theme a ratings</h1>
            <p class="text-secondary">Note : <span class="text-primary">rating is available only after the appointment is settled.</span></p>
            <div class="col-md-5 border border-light" style="height: 25em;" v-for="(sched,index) in schedule" :key="index">
                <!-- {{ sched }} -->
                <div class='card' style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                    <div class='card-body p-4'>
                        <div class='user-content'>
                            <div class="col-2 user-profile p-2" style="margin-top:2em">
                                <font-awesome-icon icon='fa-solid fa-user' class='fa-4x'  />
                            </div>
                            <div class="col-sm p-2">
                                <h4 class="card-title text-primary" style="margin-top:1em"><b>{{ sched.details }}</b></h4>
                                <p class="card-text text-secondary" style="margin-top:-5px"><b>Hi, <span class="text-primary">{{ $store.getters.getTokenName }}</span>. I would like to inform you that your appointment is already done. Thank you!</b></p>
                                <p class="card-text text-white card border border-light bg-primary p-1" style="position: absolute;top: 0; right: 0;">Date : {{ sched.date }}</p>
                                <p class="card-text text-white card border border-light bg-success p-1" style="position: absolute;top: 0; left: 0;">Status : {{ 'done'}}</p>
                                <p class="card-text text-white card border border-light bg-primary p-1" style="position: absolute;bottom: 0; left: 0;">Time : {{ sched.time }}</p>
                                <button @click="clickEvents(sched.schedule_id)" type="button" class="card-text text-white card border border-light bg-success p-1" style="position: absolute;bottom: 0; right: 0;">{{ 'Give me a rating' }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
    import axios from 'axios'
    import {useStore} from 'vuex'
    import {ref} from 'vue'
    import images from '../images/Online Doctor-amico.png'
  export default{
    setup(){},
  // load the schedule using option api
    data: function(){
      return {
          schedule: [],
          image: images,
          clearTimer: ''
        }    
    },
   
    mounted(){
        this.loadDoneApp()
     },
     methods: {
        async loadDoneApp(){
            let token = JSON.parse(localStorage.getItem("token"))
            console.log(token)
            const headers = {
                'Accept': 'application/vnd.api+json',
                'Content-Type': 'application/vnd.api+json',
                'Authorization': 'Bearer ' + token.bearerToken
                }
            await axios.get('/api/StatusDone',{headers})
            .then((res)=>{
                console.log(res)
                this.schedule = Object.values(res.data)
            })
            .catch((err)=>{
                console.log(err)
            })
        },
        clickEvents(id) {
          if(id){
            // uncomment this after you slove the ratings problem
            this.$router.push('/rating/'+id) 
          }
        },             
      },
  }
</script>
<style scoped>
::-webkit-scrollbar{
        display: none;}
    .row{
        overflow-y: auto;
        height: 450px;
    }
    .user-content{
        display: flex;
        flex-direction: row;
    }
    .user-profile{
        width: 15%;
    }
</style>