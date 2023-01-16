<template>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 bg-light p-2">
                    <h2 class="text-center"><b>Emergency Service.</b></h2>
                </div>
                    <!-- <label id="prompt">{{ permisionStatus }}</label> -->
                    <!-- {{ positionLat }} -->
                <!-- {{ mapData.student_Name }} -->
                    <div class="col-sm-8 card" id="map"></div>
                    <div class="col-sm-4 bg-dark p-5">
                        <h1 class="text-center text-white">{{ mapData.student_Name }}</h1>
                        <p class="text-secondary text-center">{{ mapData.emergency_description }}</p>
                        <button class="form-control btn btn-primary" @click="btn_Handle(mapData)">Handle</button>
                    </div>
                    
                <!-- <div v-if="msgSuccess != ''" class="col-sm-12 text-center text-white bg-dark bottom card"><b>{{ msgSuccess }}</b></div> -->
            </div>
        </div>
    </main>
</template>
<script>
    import { useStore } from 'vuex'
    import {useRouter, useRoute} from 'vue-router'
    import getEmergencyRequest from '../composables/getEmergencyRequest.js'
    import getUserLocation from '../composables/getUserLocation.js'
    export default {
        setup(){
            // const {getEmergency, student_Emergency, btn_Handle} = getEmergencyRequest()
            const{student_Emergency, btn_Handle,mapData} = getUserLocation()
            return {student_Emergency,btn_Handle, mapData}
        }
    }
</script>
<style scoped>
::-webkit-scrollbar{
        display: none;}
 .row{
    overflow-y: auto;
    /* overflow: hidden; */
    height: 420px;
    /* border: 1px solid red; */
   }
 #map { height: 30em; }
</style>