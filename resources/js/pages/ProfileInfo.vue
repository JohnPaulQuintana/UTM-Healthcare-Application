<template>
    <div class="container">
        <h4 class="text-secondary">Hello there, <span>{{ $store.getters.getTokenName }}</span></h4><br>
        <div class="row">
            <h1 class="text-center">Book Consult</h1>
            <!-- {{ doctorDetails[0] }} -->
            <div class="col-sm-8 mb-4"> 
                <div class="card responsive">
                    <div class="card-body p-4">
                        <div class="doctor-content">
                            <div class="col-sm-3 h-25 user-profile p-2">
                                <font-awesome-icon icon="fa-solid fa-user" class="fa-7x"/>
                            </div>
                            <div class="col-sm-5 p-2 h-25" >
                                <div class="star-widget" v-for="(docRating,index) in docRatings" :key="index">
                                <ul v-if="Math.round(docRating.rating / docRating.count) == 5">
                                  <li v-for="(rating,index) in ratings" :key="index">
                                      <label v-if="parseInt(rating) <= 5" class="check" :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                  </li>
                                </ul>
                                <ul v-else-if="Math.round(docRating.rating / docRating.count) == 4">
                                  <li v-for="(rating,index) in ratings" :key="index">
                                      <label v-if="parseInt(rating) <= 4" class="check" :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                      <label v-else :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                  </li>
                                  
                                </ul>
                                <ul v-else-if="Math.round(docRating.rating / docRating.count) == 3">
                                  <li v-for="(rating,index) in ratings" :key="index">
                                      <label v-if="parseInt(rating) <= 3" class="check" :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                      <label v-else :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                  </li>
                                </ul>
                                <ul v-else-if="Math.round(docRating.rating / docRating.count) == 2">
                                  <li v-for="(rating,index) in ratings" :key="index">
                                      <label v-if="parseInt(rating) <= 2" class="check" :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                      <label v-else :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                  </li>
                                </ul>
                                <ul v-else-if="Math.round(docRating.rating / docRating.count) == 1">
                                  <li v-for="(rating,index) in ratings" :key="index">
                                      <label v-if="parseInt(rating) <= 1" class="check" :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                      <label v-else :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                  </li>
                                </ul>
                                <ul v-else>
                                  <li v-for="(rating,index) in ratings" :key="index">
                                      <label  :for="index"><font-awesome-icon icon="fa-solid fa-star"/></label>
                                  </li>
                                </ul> 
                                <p class="card-text"><span>{{ doctorDetails[0].relationships.userspeciality }}</span> : {{ doctorDetails[0].relationships.username }}</p>
                                <p class="card-text">{{ doctorDetails[0].relationships.userdetails }}</p>
                              </div>           
                            </div>  
                        </div>
                        <br>
                       <div class="col-sm-12 card p-3">
                        <div class="title text-secondary text-center">
                            <h2><b>Choose Dates</b></h2>
                            <!-- {{ bookedStatusChecked }} -->
                            <p><span>Selected : </span>{{ $store.getters.getTokenDate }}</p>
                           
                        </div>
                                <div class="row" style="margin: auto;">
                                    <div class="col-sm-1 mb-2" style="width: 6rem;" v-for="(date,index) in dates" :key="index">
                                    <div class="time card border-0 rounded p-1 bg-light">
                                        <label class="option_item">
                                            <input type="checkbox" class="checkbox check-dates"  :value="date.month +', '+ date.day +', '+ date.week" :id="'dates-'+index" @click="navigateLinks">
                                            <div class="option_inner facebook text-center">
                                            <div class="tickmark"></div>
                                            <p class="text-secondary" id="weeks">{{ date.week }}</p>
                                            <h3 class="mb border border-light" id="days" style="margin-top: -5px;">{{ date.day }}</h3>
                                            <p class="mb text-secondary" id="months">{{ date.month }}</p>
                                            <!-- <p class="text-white border-bottom-0" id="booked">booked!</p> -->
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                </div>
                            <br/>
                            <!-- {{ bookedD }} -->
                            <div class="title text-secondary text-center">
                                <h2><b>Choose Time</b></h2>
                                <p><span>Selected : </span>{{ $store.getters.getTokenTime }}</p>
                            </div>
                           
                                <div class="row" style="margin: auto;">
                                    <div class="col-sm-2 mb-2" style="width: 8rem;" v-for="(date,index) in dates" :key="index">
                                    <div class="time card border-0 p-1 bg-light text-center">
                                        <label class="option_item">
                                            <!-- {{ bookedInfo }} -->
                                            <input type="checkbox" class="checkbox check-times" :value="date.hour +':'+ date.minute +' '+ date.am_pm" :id="'times-'+index" @click="navigateLinks">
                                            <div class="option_inner facebook text-center" style="width: 7rem;">
                                            <div class="tickmark"></div>
                                            <span class="text-secondary" id="time">{{ date.hour }}:{{ date.minute }} {{ date.am_pm }}</span>
                                            <!-- <span class="mb text-secondary" id="months"></span> -->
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                </div>
                               
                        <br>
                        <div class="col-sm-12">
                            <!-- :href="'/book/'+ doctorDetail.relationships.id" -->
                            <!-- link for sending request with messages form -->
                            <!-- :href="'/book/'+doctorDetail.relationships.id+'/'+bookTime+'/'+bookDate" -->

                            <!-- disable-link add later in class-->
                            <a @click="sendNotif" class="btn btn-primary form-control mb-1" id="sendR">Send Request</a>
                            <a @click="editRequest" class="btn btn-primary form-control mb-1" id="editR">Edit Request</a>
                            <a class="btn btn-primary form-control mb-1" id="deleteR">Delete Request</a>
                        </div>
                       </div>
                    </div>
                    <div class="col-sm-12" v-if="setTime == false">
                        <h2 class="text-white bg-dark text-center">Select a time first</h2>
                    </div>
                    <div class="col-sm-12" v-if="msg == true">
                        <h2 class="text-white bg-dark text-center">Booking request sent to the doctor. Please wait for the doctor's response</h2>
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
    import store from "../store/index.js";
    import sendRequest from '../composables/sendRequest.js'
    // import { reactive, ref } from 'vue'
    import $ from 'jquery'
   export default{
        setup(){
            const {sendNotif, setTime, data, msg, bookUserStatus,editRequest} = sendRequest()
            return {sendNotif, setTime, data, msg, bookUserStatus,editRequest}
        },

       
        // option api
        data: function(){
            return {
                // date puicker
                bookedD:null,
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
                bookId : null,
                dates : [],
                bookedInfo : {},
                bookedInfoTime : null,
                bookedInfoDate : null,
                statusDate : true,     
                statusTime : true,
                status: false     
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
                        this.doctorDetails = res.data.data;
                        // format
                        this.doctorDetails.forEach(element => {
                            console.log(element.attributes.day)
                            let dayJsObject = dayjs(`${element.attributes.day} ${element.attributes.starting_time}`)
                            let dateFormat = {
                                month : dayJsObject.format('MMM, YYYY'),
                                week : dayJsObject.format("dd"),
                                day : dayJsObject.format("D"),
                                hour : dayJsObject.format("hh"),
                                minute : dayJsObject.format("mm"),
                                am_pm : dayJsObject.format("A")
                            }
                            this.dates.push(dateFormat);
                        });
                        
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
                    this.doctorRatings = res.data.data
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

                // check if matched
                console.log(store.getters.getTokenTime)
                const chkDates2 = document.querySelectorAll('.check-dates')
                const chkTimes2 = document.querySelectorAll('.check-times')
                const sendR = document.querySelector('#sendR')
                const editR = document.querySelector('#editR')
                const deleteR = document.querySelector('#deleteR')
                // check dates
                chkDates2.forEach((e) => {
                  if(e.value == store.getters.getTokenDate){
                    e.checked = true
                    sendR.classList.add('disable-link')
                    editR.classList.remove('disable-link')
                    deleteR.classList.remove('disable-link')
                  }else{
                    e.check = false
                    // sendR.classList.remove('disable-link')
                  }

                  if(store.getters.getTokenDate == undefined || store.getters.getTokenDate == 0){
                    sendR.classList.remove('disable-link')
                    editR.classList.add('disable-link')
                    deleteR.classList.add('disable-link')
                  }
                })
                // check time
                chkTimes2.forEach((e) => {
                  if(e.value == store.getters.getTokenTime){
                    e.checked = true
                  }else{
                    e.check = false
                  }
                })
                
            },
            navigateLinks(){     
                // const route = useRoute();
                // const store = useStore()                     
                const chkDates = document.querySelectorAll('.check-dates')
                const chkTimes = document.querySelectorAll('.check-times')
                chkDates.forEach((e)=>{
                    // console.log(e)
                    e.addEventListener('click',function(chkDates){
                        e.setAttribute("checked", "checked");
                        e.checked = true;   
                        this.statusDate = false
                       
                        let tokenData = {
                            bearerToken : store.getters.getToken,
                            name : store.getters.getTokenName,
                            speciality : store.getters.getTokenSpeciality,
                            id : store.getters.getTokenId,
                            date : chkDates.target.value,
                            time : store.getters.getTokenTime,
                        } 
                        // restoring token in localstorage using vuex
                        store.dispatch('setToken', tokenData)
                    })
                    // single date booked
                    $('input.check-dates').on('change', function() {
                        $('input.check-dates').not(this).prop('checked', false);     
                    });
                })

                chkTimes.forEach((e)=>{
                    e.addEventListener('click',function(chkTimes){
                        e.setAttribute("checked", "checked");
                        e.checked = true;
                        this.bookedInfoTime = chkTimes.target.value
                        this.statusTime = false
                        
                        let tokenData = {
                            bearerToken : store.getters.getToken,
                            name : store.getters.getTokenName,
                            speciality : store.getters.getTokenSpeciality,
                            id : store.getters.getTokenId,
                            date : store.getters.getTokenDate,
                            time : this.bookedInfoTime,
                        } 
                        //  // restoring token in localstorage using vuex
                        store.dispatch('setToken', tokenData)
                    })
                     // single date booked
                     $('input.check-times').on('change', function() {
                        // this.setAttribute("checked", "checked");
                        $('input.check-times').not(this).prop('checked', false);            
                    });

                })
               
               
                // check if has a value
                // if(this.statusDate == false && this.statusTime == false){
                //     console.log('time n date : ')
                //     console.log(this.bookedInfoDate + ", "+this.bookedInfoTime)
                //     this.status = true
                // }else{
                //     this.status = false
                //     console.log('Select a date and time first')
                //     console.log(this.bookedInfoDate + ", "+this.bookedInfoTime)
                // }
            }
            
        },
   }
</script>


<style scoped>
@import url("https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap");

/* * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Montserrat", sans-serif;
} */
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

/* this is for date time display  */
.container .option_item {
  display: block;
  position: relative;
}

.container .option_item .checkbox {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 1;
  opacity: 0;
}

.option_item .option_inner {
  width:4rem;
  height: 40%;
  background: #fff;
  border-radius: 5px;
  text-align: center;
  cursor: pointer;
  color: #585c68;
  display: block;
  border: 2px solid transparent;
  position: relative;
}

.option_item .checkbox:checked ~ .option_inner.facebook {
  border-color: #8041b3;
  color: #8041b3;
}
.option_item .option_inner .tickmark {
  position: absolute;
  top: -1px;
  left: -1px;
  border: 10px solid;
  border-color: #000 transparent transparent #000;
  display: none;
}

.option_item .option_inner .tickmark:before {
  content: "";
  position: absolute;
  top: -7px;
  left: -11px;
  width: 15px;
  height: 5px;
  border: 2px solid;
  border-color: transparent transparent #fff #fff;
  transform: rotate(-45deg);
}

.option_item .checkbox:checked ~ .option_inner .tickmark {
  display: block;
}

.option_item .option_inner.facebook .tickmark {
  border-color: #8041b3 transparent transparent #8041b3;
}
.mb{
            margin-top: -5px;
        }
        #booked{
            margin-top: -15px;
            font-size: 10pt;
            position: absolute;
            bottom: -16px;
            left: 0;
            width: 100%;
            /* height: 20px; */
            background-color: blueviolet;
            /* z-index: 1; */
            /* color: red; */
            /* overflow: hidden; */
        }
        #months{
            font-size: 8pt;
        }
        .time:hover{
            color: red;
            /* background: rgb(194, 112, 6); */
        }
        .disable-link {
            pointer-events: none;
            display: none;
        }
        .active-link {
            pointer-events: auto;
            display: block;
        }
</style>

