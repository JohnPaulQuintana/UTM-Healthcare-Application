<template>
    <div class="container">
        <h4 class="text-secondary">Hello there, <span class="text-primary">{{ $store.getters.getTokenName }}</span></h4><br>
        <div class="row">
            <div class="col-sm-8 mb-4"> 
                <!-- {{ doctorDetails.username }} -->
                <div class="card responsive">
                    <div class="card-body p-4">
                        <div class="doctor-content">
                            <div class="col-sm-3 h-25 user-profile p-2">
                                <font-awesome-icon icon="fa-solid fa-user" class="fa-7x"/>
                            </div>
                            <div class="col-sm-5 p-2 h-25">
                                <p class="card-text"><span>{{ doctorDetails.userspeciality }}</span> : <span class="text-primary">{{ doctorDetails.username }}</span> </p>
                                <p class="card-text"><span>Position : </span><span class="text-primary">{{ doctorDetails.userdetails }}</span></p>
                            </div>  
                        </div>
                        <br>
                        <div class="card p-3 bg-secondary">
                            <div class="col-sm-12 time">
                            <p class="card-time" style="color: #fd4;">Give them a rating.</p>
                            <!-- <p class="card-time">Available Week</p> -->
                            </div>
                            <form @submit.prevent="studentRating">
                                <!-- {{ form }} -->
                                <!-- {{ form.ratings}} -->
                            <div class="col-sm-12 time">
                                <div class="star-widget">
                                    <input type="radio" id="rate-5" value="5" v-model="form.ratings">
                                    <label for="rate-5"><font-awesome-icon icon="fa-solid fa-star" /></label>
                                    <input type="radio" id="rate-4" value="4" v-model="form.ratings">
                                    <label for="rate-4"><font-awesome-icon icon="fa-solid fa-star" /></label>
                                    <input type="radio" id="rate-3" value="3" v-model="form.ratings">
                                    <label for="rate-3"><font-awesome-icon icon="fa-solid fa-star" /></label>
                                    <input type="radio" id="rate-2" value="2" v-model="form.ratings">
                                    <label for="rate-2"><font-awesome-icon icon="fa-solid fa-star" /></label>
                                    <input type="radio" id="rate-1" value="1" v-model="form.ratings">
                                    <label for="rate-1"><font-awesome-icon icon="fa-solid fa-star" /></label>
                                  
                                    
                                </div>
                                
                                <!-- <h1 class="card-text badge rounded-pill bg-info text-secondary">{{ doctorDetail.attributes.starting_time }} - {{ doctorDetail.attributes.end_time }}</h1>
                                <h1 class="card-text badge rounded-pill bg-info text-secondary">{{ doctorDetail.attributes.day }}</h1> -->
                            </div>
                           

                                <!-- <header class="text-center">I don't like it!</header> -->

                            <div class="textarea">
                                <textarea name="" id="" cols="30" placeholder="Describe your experience.." v-model="form.feedback"></textarea>
                            </div>
                            <div class="btn d-grid gap-2 p-2 ">
                                <button class="btn btn-warning" type="submit">Button</button>
                            </div>
                            </form>
                        </div>
                        <br>
                        <!-- <div class="col-sm-12">
                            <a :href="'/book/'+ doctorDetail.relationships.id" class="btn btn-primary form-control">Send Request</a>
                        
                        </div> -->
                    </div>
                </div>
            </div>
           
        </div>
    </div>
    
</template>

<!-- note i can add the content if we bind input -->
<!-- route to ratings http://127.0.0.1:8000/Rating/17 -->
<script>
    import { useRouter, useRoute } from 'vue-router'
    import { useStore } from 'vuex';
    import { reactive, ref} from 'vue'

    import axios from 'axios'
   export default{
        setup(){
            const router = useRouter()
            const route = useRoute()
            const store = useStore()
            let form = reactive({
                feedback: '',
                ratings: '',
                doctor_id: route.params.id,

            });
            // set header
            const headers = {
                    'Accept': 'application/vnd.api+json',
                    'Content-Type': 'application/vnd.api+json',
                    'Authorization': 'Bearer ' + store.getters.getToken
            }
            const studentRating = async() => {
                await axios.post('/api/ratings',form,{headers})
                .then((res)=>{
                    console.log(res)
                    // push login page by name
                    deleteBooked()
                    // router.push({name: "Student"})
                })
                //this is a problem after register
                .catch((err)=>{
                    // router.push({name: "Student"})
                    console.log(err)
                })
            }
            const deleteBooked = async()=>{
                let token = JSON.parse(localStorage.getItem('token'))
                const headers = {
                    'Accept': 'application/vnd.api+json',
                    'Content-Type': 'application/vnd.api+json',
                    'Authorization': 'Bearer ' + token.bearerToken
                }
                let tokenData = {
                    bearerToken : store.getters.getToken,
                    name : store.getters.getTokenName,
                    speciality : store.getters.getTokenSpeciality,
                    id : store.getters.getTokenId,
                    date : 0,
                    time : 0,}
                    
                await axios.delete('/api/ratings/'+store.getters.getTokenId,{headers})
                .then((res)=>{
                    console.log(res)
                    // push login page by name
                    // restoring token in localstorage using vuex
                    store.dispatch('setToken', tokenData)
                    router.push({name: "Student"})
                })
                //this is a problem after register
                .catch((err)=>{
                    // router.push({name: "Student"})
                    console.log(err)
                })   
            }
            return{
                form,studentRating
            }
           
        },

        // option api
        data: function(){
            return {
                doctorDetails: [],          
            }    
        },
        mounted(){
            console.log('dwadaw')
            this.loadDoctorDetails()
        },
        methods: {
    
    
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
                        this.doctorDetails = res.data.data[0].relationships;
                        
                })
            },
            
        },
   }
</script>


<style scoped>
::-webkit-scrollbar{
        display: none;}
 .row{
    overflow-y: auto;
    /* overflow: hidden; */
    height: 450px;
    /* border: 1px solid red; */
   }
.col-sm-8{
    margin: auto;
}
.doctor-content, .time, .form-content{
    display: flex;
    align-items: center;
    justify-content: center;
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

.star-widget input{
  display: none;
   /* background-color: #444; */
}

.star-widget label{
  font-size: 25px;
  color: #444;
  /* background-color: #444; */
  padding: 3px;
  float: right;
  /* flex: center;
   */   
  /* border: 1px solid red; */
  transition: all 0.2s ease;
  /* float: right; */
}
input:not(:checked) ~ label:hover,
input:not(:checked) ~ label:hover ~ label{
  color: #fd4;
}
input:checked ~ label{
    color: #fd4; 
    /* background-color: #fd4; */
}
input#rate-5:checked ~ label{
    color: rgb(250, 221, 0);
    text-shadow: 0 0 20px #952;
}
input#rate-1:checked ~ form header:before{
    content: "I don't like it!";
}
form header{
    width: 100%;
    font-size: 25px;
    color: #fe7;
    font-weight: 500;
    margin: 5px 0 15px 0;
    transition: all 0.2s ease;
    /* float: right; */
}

form .textarea{
    height: 100px;
    width: 100%;
    overflow: hidden;
}
form .textarea textarea{
    height: 100%;
    width: 100%;
    outline: none;
    border: 1px solid #333;
    background: #222;
    padding: 10px;
    font-size: 17px;
    color: #eee;
    resize: none;
}
/* form .btn{
    height: 45px;
    width: 100%;
    margin: 15px 0;
} */

</style>