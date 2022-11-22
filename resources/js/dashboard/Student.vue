<template>
    <!-- schedule -->
    <!-- <h1 class="text">dwada</h1> -->
    {{ docRatings }}
    <div class="container">
        <h4 class="text-secondary">Hello there, <span>{{ $store.getters.getTokenName }}</span></h4><br>
        <div class="row">
          <h1>Available Doctors</h1>
            <div id="myid" :data-id="schedule.doctor_id" @click="clickEvents(schedule.doctor_id)" class="col-sm-6 mb-4" v-for="(schedule,index) in docRatings" :key="index">
              <!-- {{ schedule }} -->
              <div class="card" >
                <div class="card-body p-1">
                  <div class="doctor-content">
                            <div class="col-sm-3 h-25 user-profile p-2">
                                <font-awesome-icon icon="fa-solid fa-user" class="fa-6x"/>
                            </div>
                            <div class="col-sm-5 p-2 h-25">
                              <p>{{ Math.round(schedule.rating / schedule.count)}}</p>
                              <div class="star-widget">
                                <ul>
                                  <li v-for="(schedule,index) in starDisplay" :key="index">
                                    <!-- i need to find a solution for this -->
                                    <!-- <p>{{ Math.round(schedule.rating / schedule.count)}}</p> -->
                                      <input type="radio" name="rate" :id="'rate-'+index" checked v-if="index == 1">
                                      <label :for="'rate-'+index"><font-awesome-icon icon="fa-solid fa-star" /></label>
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
                              <label>{{ schedule.count }} Ratings</label>
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
    // import {ref, onMounted} from 'vue'
    import $ from 'jquery'
  export default{
    setup(){},
  // load the schedule using option api
    data: function(){
      return {
          schedules: [],
          docRatings: [],
          starDisplay: [],
          val : '',
          sum : 0,
          ratings : {
              'rate-5' : 5,
              'rate-4' : 4,
              'rate-3' : 3,
              'rate-2' : 2,
              'rate-1' : 1,
          },
          startTotal : 5,
          starPercentage: null,          
          starPercentageRounded: null ,
          elements : []         
        }    
    },
    computed(){
      // this.loadSchedule()
    },
    mounted(){
        // this.loadTask();
        this.loadSchedule()
        // this.getRatings()
     },
     methods: {
      async loadSchedule(){
         const router = useRouter()
          const store = useStore()
          const headers = {
              'Accept': 'application/vnd.api+json',
              'Content-Type': 'application/vnd.api+json',
              'Authorization': 'Bearer ' + store.getters.getToken
            }
            await axios.get('/api/student',{headers})
            .then((res)=>{
              console.log(res)
              this.schedules = res.data.data
              this.starDisplay = res.data.data
              // console.log(this.schedules)

              // try to count ratings
              var ret = {}
              
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
              // this.starDisplay = Object.values(star)
              // append

              // $('.star-widget').append( "<p>Test</p>")
            })

            .catch((err)=>{
              console.log(err.response.status )
              if(err.response.status == 401 ){
                   router.push({ name: "Login"  });
                   console.log('dwahdjawd');  
              }
              
            })
      },
      clickEvents(id) {
        console.log('click : '+id)
        if(id){
          // uncomment this after you slove the ratings problem
          // this.$router.push('/profile_info/'+id) 
        }
      },
       async getRatings(){
        // for (let rating in this.ratings) {
        //   console.log(rating)
        //   console.log(this.ratings[rating])
        //   // get percentage
        //   this.starPercentage = (this.ratings[rating] / this.startTotal) * 100;
        //   console.log(this.starPercentage)

        //   // rounded to nearest 10
        //   this.starPercentageRounded = `${Math.round(this.starPercentage / 10) * 10}%`;
        //   console.log(this.starPercentageRounded)
        //    // set width of star-iiner to percentage
        //   // this.elements = document.querySelectorAll(`#${rating} font-awesome-icon`)
        //   // console.log(this.elements)
        // }
       
          const router = useRouter()
          const route = useRouter()
          const store = useStore()
          const headers = {
              'Accept': 'application/vnd.api+json',
              'Content-Type': 'application/vnd.api+json',
              'Authorization': 'Bearer ' + store.getters.getToken
            }
            await axios.get('/api/ratings',{headers})
            .then((res)=>{
              console.log(res)
              this.docRatings = res.data.data
              let x = 0;
              // console.log(this.$refs['myid'])
              let id = document.querySelectorAll('#myid');
              for(let rate in this.docRatings){
                console.log('doctor : '+this.docRatings[rate].relationship.id)
                  id.forEach(function(e){
                      // console.log(typeof(this.docRatings[rate].relationship.id))
                      let parseId = parseInt(e.dataset.id);
                      
                      console.log("id : "+parseId)
                      // ERROR DOCRATING IS UNDEFINED
                      // if(parseId == this.docRatings[rate].relationship.id){
                      //   console.log('dwawad')
                      // }
                      // check whos doctor own this
                      // if(this.docRatings[rate].relationship.id == parseId){
                      //   // x += parseInt(this.docRatings[rate].attributes.ratings)
                      //   console.log(x)
                      // }else{
                      //   console.log('not found')
                      //   console.log(typeof(this.docRatings[rate].relationship.id) + typeof(this.$refs[rate]))

                      // }
                  })
                  // x += parseInt(this.docRatings[rate].attributes.ratings)
                  // console.log(this.$refs['myid'])

                  
                  // // console.log(this.docRatings[rate].attributes.ratings)
                  // console.log("Rate : "+rate + ' Refs : ' +this.$refs[rate])//check if div is matched base on id
                  
                  //   if(this.docRatings[rate].relationship.id){
                  //     console.log('is belongs to doctor_id : '+ this.docRatings[rate].relationship.id);
                  //     //  this.val = 'checked'
                  //   }else{
                  //     console.log('is belongs to doctor_id : '+ this.docRatings[rate].relationship.id);
                  //     // this.val = 'checked'
                  //   }
                 
                  // console.log(rate[x++].attributes.ratings)
              }
            })

            .catch((err)=>{
              console.log(err)
              // if(err.response.status == 401 ){
              //      router.push({ name: "Login"  });
              //      console.log('dwahdjawd');  
              // }
              
            })

      }
        
        // setInterval(()=>{
        //   this.loadSchedule
        // },3000)

      
              
     },
  }
</script>
<style scoped>
.card {
  /* height: 20em; */
  background-color: aqua;
  overflow: hidden;
}
.card:hover{
  background-color: aliceblue;
  /* overflow: scroll; */
  /* height: 25em; */
  /* width: 20em; */
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

/* star */
.star-widget input{
  display: none;
}

.star-widget label{
  font-size: 25px;
  color: #444;
  padding: 3px;
  /* float: right; */
  transition: all 0.2s ease;
  /* float: right; */
}
/* input:not(:checked) ~ label:hover,
input:not(:checked) ~ label:hover ~ label{
  color: #fd4;
} */


/* this is the problem  */
input:checked ~ label{
  color: #fd4;
}
</style>