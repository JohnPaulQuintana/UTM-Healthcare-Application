<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6 card border border-light">
                <!-- <img v-for="(image,index) in images"  :key="index" :src="image" alt="no images found!"> -->
                <img :src="image">
            </div>
            <div class="col-md-6 card border border-light">
                <!-- {{ $store.getters.getToken }} -->
                <form @submit.prevent="login">
                    <div class="mb-3">
                        <h1 class="text-center text-primary">Login</h1>
                    </div>
                    <hr class="text-primary mb-4"/>
                    <div class="mb-3">
                        <div class="form-field">
                            <label :for="id" class="form-label text-secondary">Email ID</label>
                            <div class="mb-content">
                                <font-awesome-icon icon="fa-solid fa-at" class="icon text-primary"/>
                                <input type="email" class="input-text text-secondary" :class="className" :id="id" v-model="form.email">
                            </div>
                        </div>
                        <p :class="className" v-if="statusCode.email">{{ statusCode.email[0] }}</p>
                    </div>
                    <div class="mb-3">
                       <div class="form-field">
                            <label :for="id" class="form-label text-secondary">Password</label>
                           <div class="mb-content">
                                <font-awesome-icon icon="fa-solid fa-lock" class="icon text-primary" />
                                <input type="password" name="password" class="input-text text-secondary" :class="className" :id="id" v-model="form.password">
                           </div>
                       </div>
                       <p :class="className" v-if="statusCode.password">{{ statusCode.password[0] }}</p>
                    </div>
                    <div class="mb-3">
                        <p :class="className" v-if="statusCode.message">{{ statusCode.message }}</p>
                    </div>
                    <div class="text-center"><a href="/forgot_password">Forgot Password</a></div><br>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Login</button>
                        <div class="text-center"><span>New to BetterHealth? </span><a href="/register"> Sign Up</a></div>
                    </div>
                    <br>
                    
                    <div class="mb-3 card p-1 bg-dark text-white" v-if="$store.getters.getUpdated == 0">
                        <h3 class="text-center">Profile Updated, Please login again.</h3>
                    </div>
                    <br>
                    
                    <div class="mb-3 card p-1 bg-dark text-white" v-if="$store.getters.getUpdated == 1">
                        <h3 class="text-center">Sad to see you go! All your user data has been deleted.</h3>
                    </div>
                </form>
            </div>
           
        </div>
    </div>
</template>

<script>
import axios from 'axios'
// import { stat } from 'fs';
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import {useStore} from 'vuex'
// import fs from 'fs'
import images from "../images/login.png"
export default {
    setup(){
        const router = useRouter()
        const store = useStore()
        let form = reactive({
            email: '',
            password: '',

        });
        let id = ref(null)
        let className = ref('');
        let statusCode = ref('')
        
        const login = async() => {
            // set header
            const headers = {
                'Accept': 'application/vnd.api+json',
                'Content-Type': 'application/vnd.api+json',
                'Authorization': 'Bearer ' + store.getters.getToken 
                }
            await axios.post('/api/login',form, {headers})
            .then((res)=>{
                console.log(res)
                statusCode.value = ''
                className.value = ''

                let tokenData = {
                    bearerToken : res.data.data.token,
                    name : res.data.data.user.name,
                    speciality : res.data.data.user.speciality,
                    id : res.data.data.user.id,
                    date : store.getters.getTokenDate || 0,
                    time : store.getters.getTokenTime || 0,

                }

                // restoring token in localstorage using vuex
                store.dispatch('setToken', tokenData)
                // push login page by name
                // window.location.reload();
                // router.push({ name: '' });

                if(tokenData.speciality == 'Doctor'){
                    router.push({name: "Doctor"});
                }else{
                    router.push({name: "Student"});
                }

            })
            //this is a problem after register
            .catch((err)=>{
                console.log(err.response)
                // console.log(err.response.data.message)
                if(err.response.status === 422){
                    console.log('yes')
                    statusCode.value = err.response.data.errors  
                    className.value = 'text-danger error'
                }else{
                    statusCode.value = err.response.data
                }
            })
        }
        
        return{
            form,
            login,
            statusCode,
            className,
            id
        }

    },
    data () {
        return {
            id: null,
            // instatntiate
            image : images,
            // loginImages : './UTM-Healthcare-Application/public/images/login.png'
        }
    },
    created () {    
    },
    mounted () {
        this.id = this._uid
    },
    method: {
        
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
    .container .row .card{
        margin: 10px auto;
        padding: 2em;
    }
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
        height: 36px ;
        border-width: 0 0 2px 0;
        border-color: #5543ca;
        font-size: 16px;
        line-height: 26px;
        font-weight: 400;
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