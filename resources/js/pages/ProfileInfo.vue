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
                            <div class="col-sm-5 p-2 h-25">
                                <p class="card-text">Rating : 5</p>
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
    import { useRouter, useRoute } from 'vue-router'
    import { useStore } from 'vuex';
    import { computed } from 'vue';
   export default{
        setup(){
        //    const route = useRoute();

        //     console.log(route.params.id);
        //     computed(()=>{
        //         async () =>{
        //             await axios.get('/api/student')
        //             .then((res)=>{
        //                 console.log(res)
        //             })
        //         }
        //     })

           
        },

        // option api
        data: function(){
            return {
                doctorDetails: [],          
            }    
        },
        mounted(){
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
                        this.doctorDetails = res.data.data;
                        
                })
            }
            
        },
   }
</script>


<style scoped>
.col-sm-8{
    margin: auto;
}
.doctor-content, .time{
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
</style>