<template class="text-center">
    <div id="refresh">
    <div class="container">
        <!-- {{ dataCred }} -->
        <h5 class="text-secondary text-center" v-show="check">You have a notification from <span class="text-primary">{{ dataCred.student_name }}</span></h5>
        <hr class="text-primary" style="margin-top:-5px">
        <h4 class="text-secondary">Hello there, <span>{{ $store.getters.getTokenName }}</span><font-awesome-icon icon="fa-solid fa-hand-holding-heart" class="text-danger" /></h4><br>
        <div class="row">
           
            <h1 class="text-primary">Booking requests</h1>
            <div class="col-md-6 border border-light" style="height: 25em;" v-show="studentRequests == ''">
                <!-- <img v-for="(image,index) in images"  :key="index" :src="image" alt="no images found!"> -->
                <img :src="image" style="height: 25em; width: 100%;">
            </div>
            <div class="col-md-6 border border-light text-center text-secondary p-5" v-show="studentRequests == ''">
                <div class="p-5">
                    <h1>Nothing to display!</h1>
                    <h3>No more pending emergency calls. Wait for students to send emergency calls.</h3>
                </div>
            </div>
            <div class='col-sm-5 mb-4' v-for="(studentRequest,index) in studentRequests"  :key="index">
                <div class='card' style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                    <div class='card-body p-4'>
                        <div class='user-content'>
                            <div class="col-2 user-profile p-2">
                                <font-awesome-icon icon='fa-solid fa-user' class='fa-4x' />
                            </div>
                            <div class="col-sm p-2">
                                <h4 class="card-title text-primary"><b>{{ studentRequest.attributes.student_name }}</b></h4>
                                <p class="card-text text-secondary" style="margin-top:-5px"><b>{{ studentRequest.attributes.details}}</b></p>
                                <p class="card-text text-white card border border-light bg-primary p-1" style="position: absolute;top: 0; right: 0;">Date : {{ studentRequest.attributes.date}}</p>
                                <p class="card-text text-white card border border-light bg-primary p-1" style="position: absolute;bottom: 0; left: 0;">Time : {{ studentRequest.attributes.time}}</p>
                            </div>
                        </div>
                        <div class="col-md-12 text-end">
                            <a @click="booked(studentRequest.id)" style="cursor:pointer"><font-awesome-icon icon="fa-solid fa-circle-check" class="me-4 text-success fa-2x" /></a>
                            <a @click="rejectBooked(studentRequest.id)" style="cursor:pointer"><font-awesome-icon icon="fa-solid fa-circle-xmark" class="text-danger fa-2x" /></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-5"></div>
        </div>
    </div>
</div>
</template>
<script>
import { useStore } from 'vuex'
import {useRouter, useRoute} from 'vue-router'
import acceptBookedRequest from '../composables/acceptBookedRequest.js'
import images from '../images/noCalls.png'
import {ref,reactive} from 'vue'
import store from '../store'
    export default {
        setup (){
            const {booked,rejectBooked} = acceptBookedRequest()
            let dataCred = ref({})
            let check = ref(false)
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;
  
            var pusher = new Pusher('b423e7a8d1563736ee2e', {
                cluster: 'ap1'
            });

            var channel = pusher.subscribe('popup-channel');
            channel.bind('user-notify', function(data) {
                // app.messages.push(JSON.stringify(data));
                // alert(JSON.stringify(data))
                // var info = JSON.stringify(data)
                console.log(JSON.stringify(data))
                dataCred.value = {
                    doctor_id : data.cred.doctor_id,
                    student_id : data.cred.student_id,
                    student_name : data.cred.student_name,
                    student_booked_date : data.cred.student_booked_date,
                    student_booked_time : data.cred.student_booked_time,
                }
                // toastr.success(JSON.stringify(data)+'dwdwadwadwa')
                if(dataCred.value && dataCred.value.doctor_id == store.getters.getTokenId){
                    check.value = true
                }else{
                    check.value = false
                }

            });



            return {check,booked,rejectBooked,dataCred}
        },
        
         // load the schedule using option api
    data(){
      return {
            studentRequests: [],
            image : images,
            clearTimer : ''  
        }    
    },
    computed(){
        // this.loadBookSchedule()
    },
    mounted(){
        // this.loadTask();
        this.loadBookSchedule()
        // this.refreshStatus()
        this.clearTimer=setInterval(this.loadBookSchedule,5000)

     },
     methods: {
        loadBookSchedule(){
                // const store = useStore()
                // const router = useRouter()
                let token = JSON.parse(localStorage.getItem("token"))
                const headers = {
                    'Accept': 'application/vnd.api+json',
                    'Content-Type': 'application/vnd.api+json',
                    'Authorization': 'Bearer ' + token.bearerToken
                    }
                   axios.get('/api/bookschedule',{headers})
                    .then((res)=>{
                    // console.log(res)
                    this.studentRequests = res.data.data
                    
                    })

                    .catch((err)=>{
                    console.log(err)
                    if(err.response.status == 401 ){
                       clearInterval(this.clearTimer)
                  //  console.log('dwahdjawd');  
                    }
                    // router.push({ name: "Login"  });
                    
                })

                // setInterval(this.loadBookSchedule, 3000)
        }
              
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