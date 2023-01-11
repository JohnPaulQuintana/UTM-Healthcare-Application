<template>
   <div class="container">
      <div class="row">
        <div class="card text-start">
          <div class="card-body">
            <form @submit.prevent="consult">
                <div class="mb-3">
                    <h1 class="text-center">Consultation Form</h1>
                   
                </div>
                <hr/>
                <div class="mb-3">
                    <div class="form-field">
                        <label class="form-label text-secondary">Please explain why do you want a consultation?</label>
                        <div class="mb-content">
                            <font-awesome-icon icon="fa-solid fa-at" class="icon text-secondary"/>
                            <textarea cols="40" rows="5" class="input-text" v-model="form.details"></textarea>
                            <!-- {{ form }} -->
                        </div>
                    </div>
                    <!-- <p :class="className" v-if="statusCode.email">{{ statusCode.email[0] }}</p> -->
                </div>
                <div class="d-grid gap-2">
                    <button ref="btnStudent" class="btn btn-primary" type="submit">Send Book</button>
                    <!-- <button ref="btnDoctor" class="btn btn-primary disabled" type="submit">Send Book</button> -->
                </div>
            </form>
          </div>
        </div>
      </div>
   </div>
</template>

<script>
    import postBookSchedule from '../composables/postBookSchedule.js'
    import { useRouter, useRoute } from 'vue-router'
    import {useStore} from 'vuex'
export default {
    setup(){   
       const {form, consult} = postBookSchedule()
        return{form,consult}
    },
    data () {
        return {
            id: null,
        }
    },
    mounted () {
       
        this.id = this._uid
        this.checkIfAuthorized
    },
    created(){
            // console.log('dwadaw')
    },
    mounted () {
        this.checkIfAuthorized()
    },
    methods: {
            checkIfAuthorized(){
                console.log('dwadaw')
            
                const store = useStore()
                const route = useRoute()
                const router = useRouter()

                console.log(route.params)
                // get time and date 
                if(route.params.time == 'null' || route.params.date == 'null'){
                    // let id = route.params.id
                    router.push({name:'Popup'})
                    // router.back()
                }
                if(store.getters.getToken == 0 || store.getters.getToken == undefined){
                    console.log("not authorized")
                    router.push({name: "Login"})
                }else{
                    console.log(store.getters.getToken)
                    // if(store.getters.getTokenSpeciality == "Student" || store.getters.getTokenSpeciality == "student"){
                    //     router.push({name: "Student"})
                    // }else{
                    //     router.push({name: "Doctor"})
                    // }
                    if(store.getters.getTokenSpeciality == 'Doctor' || store.getters.getTokenSpeciality == 'doctor'){
                        console.log('Your A doctor')
                        router.push({name : "Doctor"})
                    }
                }   
            }
    } 
}
</script>



<style scoped>

    .container .row .card{
        margin: 10px auto;
        padding: 2em;
    }
    /* input{
        text-transform: uppercase;
    } */
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
        height: 100px ;
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
    /* disable button */
    .disabled{
        pointer-events: none;
    }
</style>