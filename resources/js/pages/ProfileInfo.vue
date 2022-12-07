<template>
    <div class="container">
        <h4 class="text-secondary">Hello there, <span>{{ $store.getters.getTokenName }}</span></h4><br>
        <div class="row">
            <h1 class="text-center">Book Consult</h1>
            <div class="col-sm-8 mb-4" v-for="(doctorDetail,index) in doctorDetails" :key="index"> 
                <div class="card responsive" >
                    <div class="card-body p-4">
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
                               
                              </div>   
                                <label>{{ docRatings[0].count }} Ratings</label>
                                <p class="card-text"><span>{{ doctorDetail.relationships.userspeciality }}</span> : {{ doctorDetail.relationships.username }}</p>
                                <p class="card-text">{{ 'Surgeon' }}</p>
                            </div>  
                        </div>
                        <br>
                        <div class="col-sm-12 time">
                            <p class="card-time">Available Time and Week</p>
                            <!-- <p class="card-time">Available Week</p> -->

                        </div>
                        <div class="col-sm-12 time">

                            <h1 class="card-text badge rounded-pill bg-info text-secondary">{{ doctorDetail.attributes.starting_time }} - {{ doctorDetail.attributes.end_time }}</h1>
                            <h1 class="card-text badge rounded-pill bg-info text-secondary">{{ doctorDetail.attributes.day }}</h1>
                        </div>
                        <br>
                        <div class="col-sm-12">
                            <a :href="'/book/'+ doctorDetail.relationships.id" class="btn btn-primary form-control">Send Request</a>
                        
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
    // import { computed } from 'vue';
   export default{
        setup(){},

        // option api
        data: function(){
            return {
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
            }    
        },
        mounted(){
            this.loadDoctorDetails()
            this.loadRatings()
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
                const router = useRouter()
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

