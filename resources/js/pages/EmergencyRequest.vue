<template class="text-center">
    <div id="refresh">
    <div class="container">
        <h4 class="text-secondary">Hello there, <span>{{ $store.getters.getTokenName }}</span></h4><br>
        <div class="row">
            <h1><b>Pending Emergency Calls</b></h1>
            
            <div class='col-sm-6 mb-4' v-for="(studentEmergency,index) in student_Emergency"  :key="index">
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
                        <div class="col-md-12 text-end">
                            <a :href="'puntaka/'"><font-awesome-icon icon="fa-solid fa-circle-check" class="me-4 text-success fa-2x" /></a>
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
    import { useStore } from 'vuex'
    import {useRouter, useRoute} from 'vue-router'
    import getEmergencyRequest from '../composables/getEmergencyRequest.js'
    export default {
        setup(){
            const {getEmergency,student_Emergency} = getEmergencyRequest()
            return {student_Emergency}
        }
    }
</script>
<style scope>
    .user-content{
            display: flex;
            flex-direction: row;
    }
    .user-profile{
            width: 15%;
    }
</style>