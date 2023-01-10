<template>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 bg-light p-2"><h2 class="text-center"><b>Emergency Service.</b></h2></div>
                    <!-- <label id="prompt">{{ permisionStatus }}</label> -->
                    <!-- {{ positionLat }} -->
                   
                    <div class="col-sm-12 card" id="map"></div>
                    <div class="col-sm-12 bg-dark p-4" v-for="(student, index) in student_Emergency" :key="index">
                        <h1 class="text-center text-white">{{ student.student_Name }}</h1>
                        <p class="text-secondary text-center">{{ student.emergency_description }}</p>
                        <button class="form-control btn btn-primary" @click="btn_Handle(student)">Handle</button>
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
    export default {
        setup(){
            const {getEmergency, student_Emergency, btn_Handle} = getEmergencyRequest()
            return {student_Emergency,btn_Handle}
        }
    }
</script>
<style scoped>
 #map { height: 30em; }
</style>