<template>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 bg-light p-2"><h2 class="text-center"><b>Emergency Service.</b></h2></div>
                    <!-- <label id="prompt">{{ permisionStatus }}</label> -->
                    <!-- {{ positionLat }} -->
                   
                    <div class="col-sm-12 card" id="map"></div>
                    <div class="col-sm-12 bg-dark p-4" >
                        <h1 class="text-center text-white">{{ 'student-1' }}</h1>
                        <p class="text-secondary text-center">{{ 'description' }}</p>
                        <button class="form-control btn btn-primary">Handle</button>
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
            const {getEmergency} = getEmergencyRequest()
            return {}
        }
    }
</script>
<style scoped>
 #map { height: 30em; }
</style>