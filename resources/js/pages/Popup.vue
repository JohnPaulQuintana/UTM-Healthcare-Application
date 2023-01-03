<template>
    <div>
        <div class="row">
            <div class="col-sm-6">
                <div class="card p-2">
                <div class="card-body p-4">
                    <h2 class="card-title text-center text-danger">Selecting time and date is required!.</h2>
                    <hr>
                    <h3 class="card-text text-secondary border p-2">We can't process your application because of missing Time and Dates,.</h3>
                    <!-- <a href="#" class="btn btn-primary">Select Time</a> -->
                </div>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <button class="btn btn-danger" type="button" @click="goback()">Select Time</button>
                </div>
                </div>
            </div>
            
        </div>
    </div>
</template>
<script>
import { useRouter, useRoute } from 'vue-router'
import $ from 'jquery'
    export default{
        setup() {
            const router = useRouter()
            function goback(){
                router.go(-2)
            }
            return{goback}
        },
        data:function() {
            return {
                
            }
        },
        // methods:{
        //     async goback(){
        //         const router = useRouter()
        //         router.back()
        //     }
        // }
    }
</script>
<style scoped>
    .row .col-sm-6{
        margin: 100px auto;
        height: 300px;
        /* border: 1px solid red; */
    }
    .card{
        height: 300px;
    }
    
</style>