<template class="text-center">
    <div id="refresh">
    <div class="container">
        <h4 class="text-secondary">Hello there, <span>{{ $store.getters.getTokenName }}</span></h4><br>
        <div class="row">
            <h1 class="text-primary"><b>Pending Emergency Calls</b></h1>
            <div class="col-md-6 border border-light" style="height: 25em;" v-show="student_Emergency == ''">
                <!-- <img v-for="(image,index) in images"  :key="index" :src="image" alt="no images found!"> -->
                <img :src="image" style="height: 25em; width: 100%;">
            </div>
            <div class="col-md-6 border border-light text-center text-secondary p-5" v-show="student_Emergency == ''">
                <div class="p-5">
                    <h1>Nothing to display!</h1>
                    <h3>No more pending emergency calls. Wait for students to send emergency calls.</h3>
                </div>
            </div>
            <div class='col-sm-6 mb-4' @click="clickEvents(studentEmergency.student_Id)" v-for="(studentEmergency,index) in student_Emergency"  :key="index">
                <div class='card'>
                    <div class='card-body p-4'>
                        <div class='user-content'>
                            <div class="col-2 user-profile p-2">
                                <font-awesome-icon icon='fa-solid fa-user' class='fa-4x' />
                            </div>
                            <div class="col-sm p-2">
                
                                <h4 class="card-title">{{ studentEmergency.student_Name }}</h4>
                                <p class="card-text">{{ studentEmergency.emergency_description }}</p>
                            </div>
                        </div>
                        <!-- <div class="col-md-12 text-end">
                            <a :href="'puntaka/'"><font-awesome-icon icon="fa-solid fa-circle-check" class="me-4 text-success fa-2x" /></a>
                            <a href="#"><font-awesome-icon icon="fa-solid fa-circle-xmark" class="text-danger fa-2x" /></a>
                        </div> -->
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>
</template>
<script>
    // import { useStore } from 'vuex'
    // import {useRouter, useRoute} from 'vue-router'
    import getEmergencyRequest from '../composables/getEmergencyRequest.js'
    import images from '../images/noCalls.png'
    export default {
        setup(){
            const {getEmergency,student_Emergency,clickEvents} = getEmergencyRequest()
            return {student_Emergency,clickEvents}
        },
        data () {
            return {
                
                // instatntiate
                image : images,
                // loginImages : './UTM-Healthcare-Application/public/images/login.png'
            }
        }
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
    .user-content{
            display: flex;
            flex-direction: row;
    }
    .user-profile{
            width: 15%;
    }
</style>