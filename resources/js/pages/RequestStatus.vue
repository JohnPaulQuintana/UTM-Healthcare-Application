<template>
    <div class="container">
        <!-- datepicker -->
        <!-- {{ date }}
        <Datepicker v-model="date" :is-24="false" :format="format"/> -->
        <h4 class="text-secondary">Hello there, <span>{{ $store.getters.getTokenName }}</span></h4><br>
        <div class="row">
            <h1 class="text-center">Book Consult</h1>
            <div class="col-sm-8 mb-4" v-for="(doctorDetail,index) in doctorDetails" :key="index"> 
                <div class="card responsive">
                    <!-- {{ index }}   -->
                    <div class="card-body p-4" v-if="(index == 0)">
                        <div class="doctor-content">
                            <div class="col-sm-3 h-25 user-profile p-2">
                                <font-awesome-icon icon="fa-solid fa-user" class="fa-7x"/>
                            </div>
                            <div class="col-sm-5 p-2 h-25" >
                                
                                <!-- star display -->
                                 <!-- <h1>{{ Math.round(docRatings.rating) }}</h1> -->
                                <!-- <h1 v-for="(rating,index) in ratings" :key="index">{{ }}</h1>  -->

                                <div class="star-widget" v-for="(docRating,index) in docRatings" :key="index">
                                <ul v-if="Math.round(docRating.rating / docRating.count) == 5">
                                  <li v-for="(rating,index) in ratings" :key="index">
                                    <!-- i need to find a solution for this -->
                                    <!-- <p>{{ Math.round(schedule.rating / schedule.count)}}</p> -->
                                      <!-- <input type="radio" name="rate" :id="'rate-'+index" checked v-if="index == 1"> -->
                                      <label v-if="parseInt(rating) <= 5" class="check" :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                  </li>
                                </ul>
                                <ul v-else-if="Math.round(docRating.rating / docRating.count) == 4">
                                  <li v-for="(rating,index) in ratings" :key="index">
                                    <!-- i need to find a solution for this -->
                                    <!-- {{ index[5] }} -->
                                    <!-- <p>{{ Math.round(schedule.rating / schedule.count)}}</p> -->
                                      <!-- <input type="radio" name="rate" :id="'rate-'+index" checked v-if="index == 1"> -->
                                      <label v-if="parseInt(rating) <= 4" class="check" :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                      <label v-else :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                  </li>
                                  
                                </ul>
                                <ul v-else-if="Math.round(docRating.rating / docRating.count) == 3">
                                  <li v-for="(rating,index) in ratings" :key="index">
                                    <!-- i need to find a solution for this -->
                                    <!-- <p>{{ Math.round(schedule.rating / schedule.count)}}</p> -->
                                      <!-- <input type="radio" name="rate" :id="'rate-'+index" checked v-if="index == 1"> -->
                                      <label v-if="parseInt(rating) <= 3" class="check" :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                      <label v-else :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                  </li>
                                </ul>
                                <ul v-else-if="Math.round(docRating.rating / docRating.count) == 2">
                                  <li v-for="(rating,index) in ratings" :key="index">
                                    <!-- i need to find a solution for this -->
                                    <!-- <p>{{ Math.round(schedule.rating / schedule.count)}}</p> -->
                                      <!-- <input type="radio" name="rate" :id="'rate-'+index" checked v-if="index == 1"> -->
                                      <label v-if="parseInt(rating) <= 2" class="check" :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                      <label v-else :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                  </li>
                                </ul>
                                <ul v-else-if="Math.round(docRating.rating / docRating.count) == 1">
                                  <li v-for="(rating,index) in ratings" :key="index">
                                    <!-- i need to find a solution for this -->
                                    <!-- <p>{{ Math.round(schedule.rating / schedule.count)}}</p> -->
                                      <!-- <input type="radio" name="rate" :id="'rate-'+index" checked v-if="index == 1"> -->
                                      <label v-if="parseInt(rating) <= 1" class="check" :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                      <label v-else :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                  </li>
                                </ul>
                                <ul v-else>
                                  <li v-for="(rating,index) in ratings" :key="index">
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
                                <p class="card-text"><span>{{ doctorDetail.relationships.userspeciality }}</span> : {{ doctorDetail.relationships.username }}</p>
                                <p class="card-text">{{ doctorDetail.relationships.userdetails }}</p>
                              </div>   
                                <!-- <label>{{ docRatings[0].count }} Ratings</label> -->
                                
                            </div>  
                        </div>
                        <br>
                       <div class="col-sm-12 card p-3">
                        <div class="col-sm-12 time">
                            <p class="card-time">Choose Time</p>
                            <!-- <p class="card-time">Available Week</p> -->

                        </div>
                       <!-- <form :action="'/book/'+ doctorDetail.relationships.id"> -->
                        {{ bookTime}}{{ bookDate }}
                            <div class="col-sm-12 time p-2">
                                <div class="form-check form-check-inline border" v-for="(doctorTime,index) in doctorDetails" :key="index" required>
                                    
                                    <input class="form-check-input" type="radio" id="inlineCheckbox1" :value="doctorTime.attributes.starting_time" v-model="bookTime" required>
                                    <!-- <input type="text"  class=""  :v-model="bookId" :value="doctorDetail.relationships.id"> -->
                                    <label class="form-check-label" for="inlineCheckbox1">{{ doctorTime.attributes.starting_time }}</label>
                                    <!-- if book na lalabas to --><br/>
                                    <span class="text-white border p-1 bg-danger form-control" style="font-size: 12px;"><b>Already booked!</b></span>
                                </div>
                                <!-- <h1 class="card-text badge rounded-pill bg-info text-secondary">{{ doctorSched.attributes.starting_time }} - {{ doctorDetail.attributes.end_time }}</h1> -->
                                <!-- <h1 class="card-text badge rounded-pill bg-info text-secondary">{{ doctorSched.attributes.day }}</h1> -->
                            </div>
                            <div class="col-sm-12 time">
                                <p class="card-time">Choose Date</p>
                                <!-- <p class="card-time">Available Week</p> -->

                            </div>
                            <div class="col-sm-12 time p-2">
                                <div class="form-check form-check-inline border" v-for="(doctorDate,index) in doctorDetails" :key="index">
                                    <input class="form-check-input" type="radio" id="inlineCheckbox1" :value="doctorDate.attributes.day" v-model="bookDate" required>
                                    <label class="form-check-label" for="inlineCheckbox1">{{ doctorDate.attributes.day }}</label>
                                </div>
                                <!-- <h1 class="card-text badge rounded-pill bg-info text-secondary">{{ doctorSched.attributes.starting_time }} - {{ doctorDetail.attributes.end_time }}</h1> -->
                                <!-- <h1 class="card-text badge rounded-pill bg-info text-secondary">{{ doctorSched.attributes.day }}</h1> -->
                            </div>

                       <!-- </form> -->
                        <br>
                        <div class="col-sm-12">
                            <!-- :href="'/book/'+ doctorDetail.relationships.id" -->
                            <a @click="navigateLinks" :href="'/book/'+doctorDetail.relationships.id+'/'+bookTime+'/'+bookDate" class="btn btn-primary form-control">Send Request</a>
                        </div>
                       </div>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
    
</template>


<script>
import axios from 'axios';
    import { useRouter, useRoute } from 'vue-router'
    import { useStore } from 'vuex';
    // import store from "../store/index.js";
    // import { reactive, ref } from 'vue'
    // import $ from 'jquery'
    // date picker
    // import Datepicker from '@vuepic/vue-datepicker';
    // import '@vuepic/vue-datepicker/dist/main.css'
    // import {ref} from 'vue'
    // import { computed } from 'vue';
   export default{
        setup(){
            // date we used later
            // const date = ref(new Date());
             
            // format date
            // const format = (date) => {
            //     const day = date.getDate();
            //     const month = date.getMonth() + 1;
            //     const year = date.getFullYear();
            //     const hours = date.getHours()
            //     const minutes = date.getMinutes()

            //     console.log("hours : "+hours)
            //     console.log("minute : "+minutes)
            //     console.log("month : "+month)
            //     console.log("year : "+year)

            //     console.log("dates : "+date)

            //     return `Selected date is ${day}/${month}/${year}`;
            // }
            // return {
               
            // }
        },

        // datepicker components
            // components: { Datepicker },
        // option api
        data: function(){
            return {
                // date puicker
                date:null,
                doctorDetails: [],
                doctorRatings:[],
                docRatings:[],
                ratings : {
                    'rate-1' : 1,
                    'rate-2' : 2,
                    'rate-3' : 3,
                    'rate-4' : 4,
                    'rate-5' : 5,
                },
                bookTime : null,       
                bookDate : null,  
                bookId : null     
            }    
        },
        mounted(){
            this.loadDoctorDetails()
            this.loadRatings()
            // console.log(t)
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
                    if(route.params.id){
                        console.log(route.params.id)
                    }
                    // if(store.getters.getTokenSpeciality == "Student" || store.getters.getTokenSpeciality == "student"){
                    //   console.log('student')  
                    //   router.push({name: ""})
                    // }else{
                    //   console.log('doctor')
                    //   router.push({name: "Doctor"})
                    // }
                }   
            },
            async loadDoctorDetails(){
                // const router = useRouter()
                const route = useRoute();
                const store = useStore()
                const headers = {
                    'Accept': 'application/vnd.api+json',
                    'Content-Type': 'application/vnd.api+json',
                    'Authorization': 'Bearer ' + store.getters.getToken
                }
                await axios.get('/api/student/'+route.params.id,{headers})
                    .then((res)=>{
                        console.log(res)
                        this.doctorDetails = res.data.data;
                        
                })
            },
            async loadRatings(){
                const route = useRoute();
                const store = useStore()
                const headers = {
                    'Accept': 'application/vnd.api+json',
                    'Content-Type': 'application/vnd.api+json',
                    'Authorization': 'Bearer ' + store.getters.getToken
                }
                await axios.get('/api/ratings/'+route.params.id,{headers})
                .then((res)=>{
                    // console.log(res)
                    this.doctorRatings = res.data.data
                    console.log(this.doctorRatings)
                     // algorithm for creating ratings key
                    var ret = {}
                    var print_star = {}
                    for (let i in this.doctorRatings) {
                        let key = this.doctorRatings[i].relationship.id
                        ret[key] = {
                        doctor_id: key,
                        count: ret[key] && ret[key].count ? ret[key].count + 1 : 1,
                        rating : ret[key] && ret[key].rating ? ret[key].rating += this.doctorRatings[i].attributes.ratings : this.doctorRatings[i].attributes.ratings,
                       
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
                })
                .catch((err)=>{
                    console.log(err)
                })
            },
            navigateLinks(){
                // const store = useStore()
                // const router = useRoute()
                // const route = useRoute();
                // check if valid
                // const route = useRoute();
                if(this.bookDate == null || this.bookTime == null){
                    alert('required')
                    alert(this.$route.params.id)
                    // return
                    
                }
            }
            
        },
   }
</script>


<style scoped>
.col-sm-8{
    margin: auto;
}
/* .doctor-content, .time{
    display: flex;
    align-items: center;
    justify-content: center;
} */
.doctor-content, .time, ul{
    display: flex;
    align-items: center;
    justify-content: center;
    list-style-type: none;
}
.col-sm-5{
    /* border: 1px solid red; */
    font-size: 18pt;
}
p,h1{
    margin-bottom: 0%;
}
.time{
    gap: 0.5em;
    font-size: 16pt;
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

