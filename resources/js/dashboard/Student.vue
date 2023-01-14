<template>
    <!-- schedule -->
    <!-- <h1 class="text">dwada</h1> -->
    <!-- {{ docRatings }} -->
    <div class="container">
  <!-- {{ dataCred }} -->
        <h5 class="text-secondary text-center" v-show="check">You have a notification from <span class="text-primary">{{ dataCred.doctor_name }}. kindly check your email</span></h5>
        <hr class="text-primary" style="margin-top:-5px">
        <h4 class="text-secondary">Hello there, <span>{{ $store.getters.getTokenName }}</span> <font-awesome-icon icon="fa-solid fa-hand-holding-heart" class="text-danger" /></h4><br>
        <div class="row">
          <!-- <div class="col-md-12 card" style="height: 10rem;">
     
              <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                   
                    <img :src="image.st1" class="d-block w-50" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>First slide label</h5>
                      <p>Some representative placeholder content for the first slide.</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                   
                    <img :src="image.st2" class="d-block w-50" alt="..." >
                    <div class="carousel-caption d-none d-md-block">
                      <h5>Second slide label</h5>
                      <p>Some representative placeholder content for the second slide.</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    
                    <img :src="image.st3" class="d-block w-50" alt="..." style="height: 10rem;">
                    <div class="carousel-caption d-none d-md-block">
                      <h5 class="text-end text-secondary me-5" style="margin-right:100em">Third slide label</h5>
                      <p class="text-end text-secondary">Some representative placeholder content for the third slide.</p>
                    </div>
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
          </div> -->
          <h1>Available Doctors</h1>
          <div class="col-md-6 border border-light" style="height: 25em;" v-show="docRatings == ''">
                <!-- <img v-for="(image,index) in images"  :key="index" :src="image" alt="no images found!"> -->
                <img :src="image" style="height: 25em; width: 100%;">
            </div>
            <div class="col-md-6 border border-light text-center text-secondary p-5" v-show="docRatings == ''">
                <div class="p-5">
                    <h1>Nothing to display!</h1>
                    <h3>No doctors available. Wait for doctors to set their schedules.</h3>
                </div>
            </div>
            <div id="myid" :data-id="schedule.doctor_id" @click="clickEvents(schedule.doctor_id)" class="col-sm-4 mb-4" v-for="(schedule,index) in docRatings" :key="index">
              <!-- {{ schedule }} -->
              <div class="card" >
                <div class="card-body p-1">
                  <div class="doctor-content">
                            <div class="col-sm-3 h-25 user-profile p-2">
                                <font-awesome-icon icon="fa-solid fa-user" class="fa-6x"/>
                            </div>
                            <div class="p-4"></div>
                            <div class="col-sm-5 p-2 h-25">
                              <!-- <p>{{ Math.round(schedule.rating / schedule.count)}}</p> -->
                              <div class="star-widget">
                                <ul v-if="Math.round(schedule.rating / schedule.count) == 5">
                                  <li v-for="(schedules,index) in ratings" :key="index">
                                    <!-- i need to find a solution for this -->
                                    <!-- <p>{{ Math.round(schedule.rating / schedule.count)}}</p> -->
                                      <!-- <input type="radio" name="rate" :id="'rate-'+index" checked v-if="index == 1"> -->
                                      <label v-if="parseInt(index[5]) <= 5" class="check" :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                  </li>
                                </ul>
                                <ul v-else-if="Math.round(schedule.rating / schedule.count) == 4">
                                  <li v-for="(schedules,index) in ratings" :key="index">
                                    <!-- i need to find a solution for this -->
                                    <!-- {{ index[5] }} -->
                                    <!-- <p>{{ Math.round(schedule.rating / schedule.count)}}</p> -->
                                      <!-- <input type="radio" name="rate" :id="'rate-'+index" checked v-if="index == 1"> -->
                                      <label v-if="parseInt(index[5]) <= 4" class="check" :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                      <label v-else :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                  </li>
                                  
                                </ul>
                                <ul v-else-if="Math.round(schedule.rating / schedule.count) == 3">
                                  <li v-for="(schedules,index) in ratings" :key="index">
                                    <!-- i need to find a solution for this -->
                                    <!-- <p>{{ Math.round(schedule.rating / schedule.count)}}</p> -->
                                      <!-- <input type="radio" name="rate" :id="'rate-'+index" checked v-if="index == 1"> -->
                                      <label v-if="parseInt(index[5]) <= 3" class="check" :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                      <label v-else :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                  </li>
                                </ul>
                                <ul v-else-if="Math.round(schedule.rating / schedule.count) == 2">
                                  <li v-for="(schedules,index) in ratings" :key="index">
                                    <!-- i need to find a solution for this -->
                                    <!-- <p>{{ Math.round(schedule.rating / schedule.count)}}</p> -->
                                      <!-- <input type="radio" name="rate" :id="'rate-'+index" checked v-if="index == 1"> -->
                                      <label v-if="parseInt(index[5]) <= 2" class="check" :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                      <label v-else :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                  </li>
                                </ul>
                                <ul v-else-if="Math.round(schedule.rating / schedule.count) == 1">
                                  <li v-for="(schedules,index) in ratings" :key="index">
                                    <!-- i need to find a solution for this -->
                                    <!-- <p>{{ Math.round(schedule.rating / schedule.count)}}</p> -->
                                      <!-- <input type="radio" name="rate" :id="'rate-'+index" checked v-if="index == 1"> -->
                                      <label v-if="parseInt(index[5]) <= 1" class="check" :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                      <label v-else :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                  </li>
                                </ul>
                                <ul v-else>
                                  <li v-for="(schedules,index) in ratings" :key="index">
                                    <!-- i need to find a solution for this -->
                                    <!-- <p>{{ Math.round(schedule.rating / schedule.count)}}</p> -->
                                      <!-- <input type="radio" name="rate" :id="'rate-'+index" checked v-if="index == 1"> -->
                                      <!-- <label  class="check" :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label> -->
                                      <label  :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                  </li>
                                </ul>
                                <!-- <input type="radio" name="rate" id="rate-5"> -->
                                <!-- <label :for="index"><font-awesome-icon icon="fa-solid fa-star" v-for="(schedule,index) in starDisplay" :key="index" /></label> -->
                                <!-- <input type="radio" name="rate" id="rate-4">
                                <label for="rate-4"><font-awesome-icon icon="fa-solid fa-star" /></label>
                                <input type="radio" name="rate" id="rate-3">
                                <label for="rate-3"><font-awesome-icon icon="fa-solid fa-star" /></label>
                                <input type="radio" name="rate" id="rate-2">
                                <label for="rate-2"><font-awesome-icon icon="fa-solid fa-star" /></label>
                                <input type="radio" name="rate" id="rate-1">
                                <label for="rate-1"><font-awesome-icon icon="fa-solid fa-star" /></label> -->
                               
                              </div>
                              <!-- <label v-if="schedule.rating != 0">{{ schedule.count }} Ratings</label> -->
                              <p class="card-text"><span>{{ schedule.userspeciality }}</span> {{ schedule.username }}</p>
                              <p class="card-text">{{ 'Surgeon' }}</p>
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
    // import Datepicker from 'vue3-datepicker'
    // import { stat } from 'fs';
    // import { reactive, ref } from 'vue'
    // import { useRouter } from 'vue-router'
    import {useStore} from 'vuex'
    import {useRouter, useRoute} from 'vue-router'
// import { count } from 'console'
// import { match } from 'assert'
    import {ref, onMounted} from 'vue'
    import $ from 'jquery'
    import images from '../images/Online Doctor-amico.png'
  export default{
    setup(){
            const store = useStore()
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
                    doctor_name : data.cred.doctor_name,
                   
                }
                // toastr.success(JSON.stringify(data)+'dwdwadwadwa')
                if(dataCred.value && dataCred.value.student_id == store.getters.getTokenId){
                    check.value = true
                }else{
                    check.value = false
                }

            });
            return {dataCred,check}
    },
  // load the schedule using option api
    data: function(){
      return {
        
          schedules: [],
          docRatings: [],
          starDisplay: [],
          ratings : {
              'rate-1' : 1,
              'rate-2' : 2,
              'rate-3' : 3,
              'rate-4' : 4,
              'rate-5' : 5,
          },
          image: images,
          clearTimer: ''
        }    
    },
    computed(){
      // this.loadSchedule()
    },
    mounted(){
        // this.loadTask();
        this.loadSchedule()
        this.checkIfAuthorized()

        this.clearTimer=setInterval( this.loadSchedule, 5000)
        // this.getRatings()
     },
     methods: {

      checkIfAuthorized(){
                console.log('dwadaw')
                const store = useStore()
                const router = useRouter()
                if(store.getters.getToken == 0 || store.getters.getToken == undefined){
                    console.log("not authorized")
                    router.push({name: "Login"})
                }else{
                  console.log(store.getters.getToken)
                    if(store.getters.getTokenSpeciality == "Student" || store.getters.getTokenSpeciality == "student"){
                      console.log('student')  
                      router.push({name: "Student"})
                    }else{
                      console.log('doctor')
                      router.push({name: "Doctor"})
                    }
                }   
      },
      async loadSchedule(){
        //  const router = useRouter()
          // const store = useStore()
          let token = JSON.parse(localStorage.getItem("token"))
          console.log(token)
          const headers = {
              'Accept': 'application/vnd.api+json',
              'Content-Type': 'application/vnd.api+json',
              'Authorization': 'Bearer ' + token.bearerToken
            }
            await axios.get('/api/student',{headers})
            .then((res)=>{
              console.log(res)
              this.schedules = res.data.data
              this.starDisplay = res.data.data
              
              // algorithm for creating ratings key
              var ret = {}
              var print_star = {}
              for (let i in this.schedules) {
                let key = this.schedules[i].attributes.doctor_id
                ret[key] = {
                  doctor_id: key,
                  count: ret[key] && ret[key].count ? ret[key].count + 1 : 1,
                  rating : ret[key] && ret[key].rating ? ret[key].rating += this.schedules[i].ratings.rating : this.schedules[i].ratings.rating,
                  speciality : this.schedules[i].relationships.userspeciality,
                  username : this.schedules[i].relationships.username
                }
              }
              console.log(Object.values(ret))
              this.docRatings = Object.values(ret)

              for(let x in this.ratings){
                let star = this.ratings[x];
                print_star[star] = {
                  star : star,
                  ratings : this.docRatings
                }
              }              
              // console.log(Object.values(print_star))
      
            })

            .catch((err)=>{
              console.log(err.response.status )
              if(err.response.status == 401 ){
                  //  $router.push({ name: "Login"  });
                   clearInterval(this.clearTimer)
                  //  console.log('dwahdjawd');  
              }
              
            })
      },
        clickEvents(id) {
          if(id){
            // uncomment this after you slove the ratings problem
            this.$router.push('/profile_info/'+id) 
          }
        },             
      },
  }
</script>
<style scoped>
::-webkit-scrollbar{
        display: none;}
    .container{
        overflow-y: auto;
        height: 450px;
    }
.card {
  /* height: 20em; */
  background-color: aqua;
  overflow: hidden;
}
.card:hover{
  background-color: aliceblue;
  z-index: 1;
}
.doctor-content, .time, ul{
    display: flex;
    align-items: center;
    justify-content: center;
    list-style-type: none;
}
ul{
  margin: 0;
  padding: 0;
}
.col-sm-5{
    /* border: 1px solid red; */
    font-size: 14pt;
}
p{
    margin-bottom: 0%;
}

.star-widget label{
  font-size: 25px;
  color: #444;
  padding: 3px;
  transition: all 0.2s ease;
}

/* this is the problem  */
label.check{
  color: #fd4;
}


</style>