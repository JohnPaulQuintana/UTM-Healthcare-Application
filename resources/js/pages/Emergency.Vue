<template>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 bg-light p-2"><h2 class="text-center text-secondary">Emergency Service.</h2></div>
                    <!-- <label id="prompt">{{ permisionStatus }}</label> -->
                    <!-- {{ positionLat }} -->
                   
                    <div class="col-sm-6 card" id="map"></div>
                    <div class="col-sm-6 card">
                        <form @submit.prevent="emergencyAlert">
                           <div class="mb-4"></div>
                            <div class="mb-3">
                                <div class="form-field">
                                    <label class="form-label text-secondary">Description for emergency</label>
                                    <div class="mb-content">
                                        <!-- <font-awesome-icon icon="fa-solid fa-at" class="icon text-secondary"/> -->
                                        <font-awesome-icon icon="fa-solid fa-truck-medical" class="icon text-secondary" />
                                        <textarea cols="40" rows="5" class="input-text" v-model="form.emergency_description"></textarea>
                                    
                                    </div>
                                </div>
                                <!-- auto clear if may value goods to -->
                                <!-- <p v-if="form.emergency_description == ''" class="text-center text-danger">{{ msg }}</p> -->
                                <p v-if="msgError != ''" class="text-danger"><b>{{ msgError }}</b></p>
                            </div>
                            <div class="d-grid gap-2">
                                <button ref="btnStudent" class="btn btn-primary" type="submit">Request</button>
                                <!-- <button ref="btnDoctor" class="btn btn-primary disabled" type="submit">Send Book</button> -->
                            </div>
                        </form>
                    </div>
                    <!-- <div class="col-sm-6 card" id="map"></div> -->
                    <div class="col-sm-12 card bg-dark p-2" v-if="permisionStatus == 'denied'"><h2 class="text-center text-white">Go to settings and enable location permission.</h2></div>
                    <div class="col-sm-6 card emergency-info">
                        <div class="icon text-secondary">
                            <i class="fa-solid fa-truck-medical"></i>
                        </div>
                        <!-- <div class="text border">
                            <form action="#">
                                <div class="mb-3 border">
                                    <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </form>
                        </div> -->
                    </div>
                  
                <div v-if="msgSuccess != ''" class="col-sm-12 text-center text-white bg-dark bottom card"><b>{{ msgSuccess }}</b></div>
            </div>
        </div>
    </main>
</template>
<script>
    import axios from 'axios'
    import { ref,onMounted} from 'vue'
    import { useRouter } from 'vue-router'
    import postBookSchedule from '../composables/postBookSchedule.js'
    // import { useRouter, useRoute } from 'vue-router'
    import {useStore} from 'vuex'
    export default {
        setup(){
            const renderResponse = ref()
            const renderData = ref()
            let renderMap = ref()
            let renderMarker = ref()
            let renderAttr = ref()
            let renderTileUrls = ref()
            let renderTiles = ref()
            let positionLat = ref(null)
            let positionLong = ref(null)
            let loc = ref(null)
            let permisionStatus = ref()
            const router = useRouter()
            onMounted(async () => {
                // rendered map
                renderMap = L.map('map').setView([14.6741293, 120.51129070000002], 12);
                renderMarker = L.marker([0, 0]).addTo(renderMap);
                renderAttr = '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                renderTileUrls = 'https://tile.openstreetmap.org/{z}/{x}/{y}.png'
                renderTiles = L.tileLayer(renderTileUrls, {renderAttr})
                // get user location first also a granted state
                navigator.geolocation.getCurrentPosition((position)=>{
                    console.log(position.coords.latitude)
                    positionLat.value = position.coords.latitude
                    positionLong.value = position.coords.longitude
                    locationCred(positionLat.value,positionLong.value)
                },(error)=>{
                    console.log(error)
                    permisionStatus.value = 'denied'
                    renderTiles.addTo(renderMap)
                }) 
            })
            // for granted
            function locationCred(latitude,longitude){
                console.log(latitude + " : " + longitude)
                navigator.permissions.query({ name: 'geolocation'})
                    .then((status)=>{
                        console.log(status.state)
                        permisionStatus.value = status.state
                        if(status.state == "granted"){  
                            renderTiles.addTo(renderMap)
                            renderMarker.setLatLng([latitude, longitude])
                            // ready user location cred to store to db
                            form.latitude = latitude
                            form.longitude = longitude
                        }
                    })
                    .catch((error)=>{
                        console.log(error)
                    })
            }
            
            // for send emergency
            const {form, emergencyAlert,msgError,msgSuccess} = postBookSchedule()
            
            return {form,emergencyAlert,msgError,msgSuccess,locationCred,renderData,renderMap,renderAttr,renderTiles,renderTileUrls,permisionStatus,positionLat,positionLong}
        }
   }
    
</script>
<style scoped>
    /* .col-sm-6{height: 40em;} */
    #map { height: 40em; }
    .emergency-info{
        display: flex;
        flex-direction: row;
        height: fit-content;
    }
    .emergency-info .icon{
        font-size: 2em;
    }
    /* .bottom{
        height: 100px;
    } */
    /* send book */
    .mb-3 .form-field{
        position: relative;
    }
    .mb-3 .form-field .mb-content{
        /* position: relative; */
        display: flex;
        flex-direction: row;
        gap: 1em;
        margin: auto;
    }
    .mb-3 .form-field .mb-content .icon{
        /* position: absolute; */
        /* top: calc(50%); */
        margin: 5px auto;
        /* color: aqua; */
        font-size: 18pt;
        /* border: 1px solid red; */
    }
    .mb-3 .form-field .mb-content .input-text{
        display: block;
        width: 100%;
        height: 50px ;
        border-width: 0 0 2px 0;
        border-color: #5543ca;
        font-size: 16px;
        line-height: 26px;
        font-weight: 400;
        padding: 10px;
    }
    .mb-3 .form-field .mb-content .error{
        border-color: #dd0e29;
    }

    .mb-3 .form-field .input-text:focus
    
    {
        outline: none;
    }
    .mb-3 .form-field label{
        position: absolute;
        top: -11px;
        left: 40px;
        cursor: text;
        /* transition: transform 0.2s ease-in-out; */
    }
    p{
        margin-left: 50px;
    }
</style>