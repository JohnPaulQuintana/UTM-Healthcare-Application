<template class="text-center">
    <div id="refresh">
    <div class="container">
        <h4 class="text-secondary">Hello there, <span>{{ $store.getters.getTokenName }}</span><font-awesome-icon icon="fa-solid fa-hand-holding-heart" class="text-danger" /></h4><br>
        <div class="row">
            <h1 class="text-primary" v-show="checkStatusData">Booked requests Status</h1>
            <!-- {{ checkStatusData }}
            {{ checkStatusDataPending }}
            <h1 class="text-primary">Booking requests Status</h1>
            <div class="col-md-6 border border-light" style="height: 25em;" v-show="studentRequests == ''">
                
                <img :src="image" style="height: 25em; width: 100%;">
            </div>
            <div class="col-md-6 border border-light text-center text-secondary p-5" v-show="studentRequests == ''">
                <div class="p-5">
                    <h1>Nothing to display!</h1>
                    <h3>No more pending request..</h3>
                </div>
            </div> -->
            <!-- {{ checkStatusData }} -->
            <div class='col-sm-5 mb-4' v-show="checkStatusData" v-for="(checkStatusDatas,index) in checkStatusData" :key="index">
                <div class='card' style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                    <div class='card-body p-4'>
                        <div class='user-content'>
                            <div class="col-2 user-profile p-2" style="margin-top:2em">
                                <font-awesome-icon icon='fa-solid fa-user' class='fa-4x'  />
                            </div>
                            <div class="col-sm p-2">
                                <h4 class="card-title text-primary" style="margin-top:1em"><b>{{ checkStatusDatas.details }}</b></h4>
                                <p class="card-text text-secondary" style="margin-top:-5px"><b>Hi, <span class="text-primary">{{ $store.getters.getTokenName }}</span>. I would like to inform you that your request is already processed. Thank you!</b></p>
                                <p class="card-text text-white card border border-light bg-primary p-1" style="position: absolute;top: 0; right: 0;">Date : {{ checkStatusDatas.date }}</p>
                                <p class="card-text text-white card border border-light bg-success p-1" style="position: absolute;top: 0; left: 0;">Status : {{ checkStatusDatas.status }}</p>
                                <p class="card-text text-white card border border-light bg-primary p-1" style="position: absolute;bottom: 0; left: 0;">Time : {{ checkStatusDatas.time }}</p>
                            </div>
                        </div>
                        <!-- <div class="col-md-12 text-end">
                            <a style="cursor:pointer"><font-awesome-icon icon="fa-solid fa-circle-check" class="me-4 text-success fa-2x" /></a>
        
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- <h1 class="text-danger" v-if="checkStatusDataPending">Pending Request Status</h1> -->
            <div class='col-sm-5 mb-4' v-show="checkStatusDataPending" v-for="(checkStatusDatas,index) in checkStatusDataPending" :key="index">
                <div class='card' style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                    <div class='card-body p-4'>
                        <div class='user-content'>
                            <div class="col-2 user-profile p-2" style="margin-top:2em">
                                <font-awesome-icon icon='fa-solid fa-user' class='fa-4x'  />
                            </div>
                            <div class="col-sm p-2">
                                <h4 class="card-title text-primary" style="margin-top:1em"><b>{{ 'UTM-Healthcare Assistance' }}</b></h4>
                                <p class="card-text text-secondary" style="margin-top:-5px"><b>hello, <span class="text-primary">{{ $store.getters.getTokenName }}</span>. Your request is forwarded. wait for the doctor response.!</b></p>
                                <p class="card-text text-white card border border-light bg-primary p-1" style="position: absolute;top: 0; right: 0;">Date : {{ checkStatusDatas.date }}</p>
                                <p class="card-text text-white card border border-light bg-danger p-1" style="position: absolute;top: 0; left: 0;">Status : {{ checkStatusDatas.status }}</p>
                                <p class="card-text text-white card border border-light bg-primary p-1" style="position: absolute;bottom: 0; left: 0;">Time : {{ checkStatusDatas.time }}</p>
                            </div>
                        </div>
                        <!-- <div class="col-md-12 text-end">
                            <a style="cursor:pointer"><font-awesome-icon icon="fa-solid fa-circle-check" class="me-4 text-success fa-2x" /></a>
        
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- {{ checkStatusDataReject }} -->
            <!-- <h1 class="text-danger" v-show="checkStatusDataReject">Rejected Request Status</h1> -->
            <div class='col-sm-5 mb-4' v-show="checkStatusDataReject" v-for="(checkStatusDatas,index) in checkStatusDataReject" :key="index">
                <div class='card' style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                    <div class='card-body p-4'>
                        <div class='user-content'>
                            <div class="col-2 user-profile p-2" style="margin-top:2em">
                                <font-awesome-icon icon='fa-solid fa-user' class='fa-4x'  />
                            </div>
                            <div class="col-sm p-2">
                                <h4 class="card-title text-primary" style="margin-top:1em"><b>{{ checkStatusDatas.details }}</b></h4>
                                <p class="card-text text-secondary" style="margin-top:-5px"><b>hello, <span class="text-primary">{{ $store.getters.getTokenName }}</span>. Your request is rejected!. try to make a request again.</b></p>
                                <p class="card-text text-white card border border-light bg-primary p-1" style="position: absolute;top: 0; right: 0;">Date : {{ checkStatusDatas.date }}</p>
                                <p class="card-text text-white card border border-light bg-danger p-1" style="position: absolute;top: 0; left: 0;">Status : {{ checkStatusDatas.status }}</p>
                                <p class="card-text text-white card border border-light bg-primary p-1" style="position: absolute;bottom: 0; left: 0;">Time : {{ checkStatusDatas.time }}</p>
                            </div>
                        </div>
                        <!-- <div class="col-md-12 text-end">
                            <a style="cursor:pointer"><font-awesome-icon icon="fa-solid fa-circle-check" class="me-4 text-success fa-2x" /></a>
        
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="p-5"></div>
        </div>
    </div>
</div>
</template>
<script>
import { useStore } from 'vuex'
import {useRouter, useRoute} from 'vue-router'
import sendRequest from '../composables/sendRequest.js'
import images from '../images/noCalls.png'
export default {
        setup (){
            const {checkStatusData,checkStatusDataPending,checkStatus,checkStatusDataReject} = sendRequest()
            return {checkStatusData,checkStatusDataPending,checkStatusDataReject}
        },
        
         // load the schedule using option api
    data(){
      return {
            studentRequests: [],
            image : images   
        }    
    }
}
</script>

<style scoped>
::-webkit-scrollbar{
        display: none;}
    .row{
        overflow-y: auto;
        height: 450px;
    }
    .user-content{
        display: flex;
        flex-direction: row;
    }
    .user-profile{
        width: 15%;
    }
</style>