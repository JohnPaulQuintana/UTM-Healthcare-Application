<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mt-5" style="height: 25em;">
                <!-- <img v-for="(image,index) in images"  :key="index" :src="image" alt="no images found!"> -->
                <img :src="image" style="height: 25em; width: 100%;">
            </div>
            <div class="col-md-6 card" id="prof">
                <!-- {{ form }} -->
                <form @submit.prevent="signup">
                    <div class="mb-3">
                        <h1 class="text-center text-primary"><b>Edit Profile</b></h1>
                        <!-- User Here -->
                        <div class="profile">
                            <font-awesome-icon icon="fa-solid fa-user" class="icon text-secondary userProfile"/>
                        </div>
                       <div class="profileName text-secondary">
                            <h3><b>{{ $store.getters.getTokenName }}</b></h3>
                       </div>
                    </div>
                    <hr/>
                    <div class="mb-3">
                        <div class="form-field">
                            <label :for="id" class="form-label text-secondary"><b>Email ID</b></label>
                            <div class="mb-content">
                                <font-awesome-icon icon="fa-solid fa-at" class="icon text-primary"/>
                                <input type="email" name="email" class="input-text text-secondary" :class="className" :id="id" v-model="form.email">
                            </div>
                        </div>
                        <p :class="className" v-if="statusCode.email">{{ statusCode.email[0] }}</p>
                    </div>
                    <div class="mb-3">
                       <div class="form-field">
                            <label :for="id" class="form-label text-secondary"><b>Current-Password</b></label>
                           <div class="mb-content">
                                <font-awesome-icon icon="fa-solid fa-lock" class="icon text-primary" />
                                <input type="password" name="password" class="input-text text-secondary" :class="className" :id="id" v-model="form.current_password">
                           </div>
                       </div>
                       <p :class="className" v-if="statusCode.current_password">{{ statusCode.current_password[0] }}</p>
                    </div>
                    <div class="mb-3">
                        <div class="form-field">
                            <label class="form-label text-secondary"><b>New Password</b></label>
                            <div class="mb-content">
                                <font-awesome-icon icon="fa-solid fa-lock" class="icon text-primary"/>
                                <input type="text" name="name" class="input-text text-secondary" :class="className" :id="id" v-model="form.new_password">
                            </div>
                        </div>
                        <p :class="className" v-if="statusCode.new_password">{{ statusCode.new_password[0] }}</p>
                    </div>
                    <div class="mb-3">
                        <div class="form-field">
                            <label class="form-label text-secondary"><b>Confirmed-Password</b></label>
                            <div class="mb-content">
                                <font-awesome-icon icon="fa-solid fa-lock" class="icon text-primary"/>
                                <input type="text" name="name" class="input-text text-secondary" :class="className" :id="id" v-model="form.password_confirmation">
                            </div>
                        </div>
                        <p :class="className" v-if="statusCode.password_confirmation">{{ statusCode.password_confirmation[0] }}</p>
                    </div>
                    <div class="mb-3">
                        <div class="form-field">
                            <label class="form-label text-secondary"><b>Name</b></label>
                            <div class="mb-content">
                                <font-awesome-icon icon="fa-solid fa-user" class="icon text-primary"/>
                                <input type="text" name="name" class="input-text text-secondary" :class="className" :id="id" v-model="form.name">
                            </div>
                        </div>
                        <p :class="className" v-if="statusCode.name">{{ statusCode.name[0] }}</p>
                    </div>
                    <div class="d-grid gap-2">
                        <input id="btnEdit" class="btn btn-primary" type="submit" v-model="form.edit">
                        <button id="btnDelete" class="btn btn-primary" type="button" @click="btnDelete">Delete</button>
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
import { useStore } from 'vuex'
import images from '../images/profile.png'
import $ from 'jquery'
export default {
    setup(){
        const router = useRouter()
        const store = useStore()
        let form = reactive({
            email: '',
            current_password: '',
            new_password: '',
            password_confirmation: '',
            // password_confirmation:'',
            name: '',
            token: store.getters.getToken,
            edit: 'Edit',
            delete:'Delete'

        });
        let empty = ref(false)
        let className = ref('');
        let statusCode = ref('')
         // set header
         const headers = {
                'Accept': 'application/vnd.api+json',
                'Content-Type': 'application/vnd.api+json',
                'Authorization': 'Bearer ' + store.getters.getToken
                }
        // Delete User
       const btnDelete = async() =>{
        await axios.delete('/api/delete/'+store.getters.getTokenId,{headers})
        .then((res)=>{
            console.log(res)
            if(res.data === 1){
                let defaultToken = {
                    bearerToken : 0,
                    name : 0,
                    speciality : 0,
                    updated : 1
                }
                store.dispatch('removeToken',defaultToken)
                router.push({name : "Login"})
            }
        })
       }
        const signup = async() => {
            await axios.post('/api/update/'+store.getters.getTokenId,form, {headers})
            .then((res)=>{
                console.log(res)
                console.log(res.data.data.token)
                console.log(res.data.data.user.name)
                statusCode.value = ''
                className.value = ''
                let defaultToken = {
                    bearerToken : 0,
                    name : 0,
                    speciality : 0,
                    id : 0,
                    updated: 0
                }
                // restoring token name in localstorage
                store.dispatch('setToken',defaultToken)
               
                // push login page by name
                router.push({ name: 'Login' });
            })
            //this is a problem after register
            .catch((err)=>{
                if(err.response.status === 422){
                    console.log('yes')
                    statusCode.value = err.response.data.errors  
                    className.value = 'text-danger error'
                }else{
                   console.log(err)
                    
                    // className.value = 'text-danger error'
                }
            })
        }
        return{
            form,
            signup,
            statusCode,
            className,
            empty,btnDelete
          
        }

        

    },
    data () {
        return {
            id: null,
            image:images
        }
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
 .row, #prof{
    overflow-y: auto;
    /* overflow: hidden; */
    height: 450px;
    /* border: 1px solid red; */
   }
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
    /* disable button */
    .disabled{
        pointer-events: none;
    }
    .profile{
        font-size: 5em;
        border: 1px solid rgb(99, 95, 95);
        width: 100px;
        margin: auto;
        text-align: center;
        border-radius: 50%;
        /* border: #dd0e29; */
        /* padding: 5px; */
    }
    .profileName{
        font-size: 2em;
        width: fit-content;
        margin: auto;
        /* border: 1px solid red; */
        
    }
</style>