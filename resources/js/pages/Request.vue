<template class="text-center">
    <div id="refresh">
    <div class="container">
        <h4 class="text-secondary">Hello there, <span>{{ $store.getters.getTokenName }}</span></h4><br>
        <div class="row">
            <h1>Booking requests</h1>
            
            <div class='col-sm-6 mb-4' v-for="(studentRequest,index) in studentRequests"  :key="index">
                <div class='card'>
                    <div class='card-body p-4'>
                        <div class='user-content'>
                            <div class="col-2 user-profile p-2">
                                <font-awesome-icon icon='fa-solid fa-user' class='fa-4x' />
                            </div>
                            <div class="col-sm p-2">
                                <h4 class="card-title">{{ studentRequest.attributes.student_name }}</h4>
                                <p class="card-text">{{ studentRequest.attributes.details}}</p>
                            </div>
                        </div>
                        <div class="col-md-12 text-end">
                            <a :href="'puntaka/'+studentRequest.id"><font-awesome-icon icon="fa-solid fa-circle-check" class="me-4 text-success fa-2x" /></a>
                            <a href="#"><font-awesome-icon icon="fa-solid fa-circle-xmark" class="text-danger fa-2x" /></a>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>
</template>
<script>
import { useRouter } from 'vue-router'
import $ from 'jquery'
// import router from '../router';
import { useStore } from 'vuex'
    export default {
        setup (){
            
        },
        
         // load the schedule using option api
    data(){
      return {
            studentRequests: []
                     
        }    
    }, 
    mounted(){
        // this.loadTask();
        this.loadBookSchedule()
        this.checkIfAuthorized()
     },
     methods: {
        checkIfAuthorized(){
                console.log('dwadaw ito po')
                const store = useStore()
                const router = useRouter()
                if(store.getters.getToken == 0 || store.getters.getToken == undefined){
                    console.log("not authorized")
                    router.push({name: "Login"})
                }else{
                  console.log(store.getters.getToken)
                    if(store.getters.getTokenSpeciality == "Student" || store.getters.getTokenSpeciality == "student"){
                        console.log(store.getters.getTokenSpeciality)
                        router.push({name: "Student"})
                    }else{
                        console.log('ito ginwa')
                        router.push({name: "Doctor"})
                    }
                }   
      },
        loadBookSchedule(){
                const store = useStore()
                const router = useRouter()
                const headers = {
                    'Accept': 'application/vnd.api+json',
                    'Content-Type': 'application/vnd.api+json',
                    'Authorization': 'Bearer ' + store.getters.getToken
                    }
                   axios.get('/api/bookschedule',{headers})
                    .then((res)=>{
                    console.log(res)
                    this.studentRequests = res.data.data
                    })

                    .catch((err)=>{
                    console.log(err)
                    if(err.response.status == 401 ){
                        router.push({ name: "Login"  });
                  //  console.log('dwahdjawd');  
                    }
                })
                // setInterval(this.loadBookSchedule, 3000)
        },

        // loadBookSchedule(){
        //     const store = useStore()
        //     $.ajax({
        //         url: '/api/bookschedule',
        //         method: 'GET',
        //         dataType: 'JSON',
        //         headers: {
        //             'Accept': 'application/vnd.api+json',
        //             'Content-Type': 'application/vnd.api+json',
        //             'Authorization': 'Bearer ' + store.getters.getToken
        //         },
        //         success:function(res){
        //             this.studentRequests = res.data
        //             // console.log(res.data[0].id)
        //             res.data.forEach(element => {
        //                $('.row').append(
                        //    `<div class='col-sm-6 mb-4'>
                        //         <div class='card'>
                        //         <div class='card-body p-4'>
                        //             <div class='user-content'>
                        //                 <div class="col-2 user-profile p-2">
                        //                     <i class='fa-solid fa-user' class='fa-4x'></i>
                        //                 </div>
                        //                 <div class="col-sm p-2">
                        //                     <h4 class="card-title">${element.id}</h4>
                        //                     <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        //                 </div>
                        //             </div>
                        //             <div class="col-md-12 text-end">
                        //                 <a href="#"><i class="fa-solid fa-circle-check" class="me-4 text-success fa-2x" ></i></a>
                        //                 <a href="#"><font-awesome-icon icon="fa-solid fa-circle-xmark" class="text-danger fa-2x"/></a>
                        //             </div>
                        //         </div>
                        //         </div>
                        //     </div>
        //                    `
        //                )
        //           });
        //         },
        //         error:function(err){
        //             console.log(err)
        //         }
        //     })
        // }
        
        // setInterval(()=>{
        //   this.loadSchedule
        // },3000)

      
              
     },
    }

    
</script>
<style scoped>
    .user-content{
        display: flex;
        flex-direction: row;
    }
    .user-profile{
        width: 15%;
    }
</style>