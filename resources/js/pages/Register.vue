<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6 card border border-light">
                <!-- <img v-for="(image,index) in images"  :key="index" :src="image" alt="no images found!"> -->
                <img :src="image">
            </div>
            <div class="col-md-6 card">
                <!-- {{ form }} -->
                <form @submit.prevent="signup">
                    <div class="mb-3">
                        <h1 class="text-center text-primary">Sign up</h1>
                    </div>
                    <hr/>
                    <div class="mb-3">
                        <div class="form-field">
                            <label :for="id" class="form-label text-secondary">Email ID</label>
                            <div class="mb-content">
                                <font-awesome-icon icon="fa-solid fa-at" class="icon text-primary"/>
                                <input type="email" name="email" class="input-text text-secondary" :class="className" :id="id" v-model="form.email">
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
                    <!-- <div class="mb-3">
                        <div class="form-field">
                            <label :for="id" class="form-label text-secondary">Confirm-Password</label>
                            <div class="mb-content">
                                <font-awesome-icon icon="fa-solid fa-lock" class="icon text-secondary"/>
                                <input type="password" name="password" class="input-text text-secondary" :class="className" :id="id" v-model="form.password_confirmation">
                            </div>
                        </div>
                        <p :class="className" v-if="statusCode.password">{{ statusCode.password[0] }}</p>
                    </div> -->
                    <div class="mb-3">
                        <div class="form-field">
                            <label :for="id" class="form-label text-secondary">Name</label>
                            <div class="mb-content">
                                <font-awesome-icon icon="fa-solid fa-user" class="icon text-primary"/>
                                <input type="text" name="name" class="input-text text-secondary" :class="className" :id="id" v-model="form.name">
                            </div>
                        </div>
                        <p :class="className" v-if="statusCode.name">{{ statusCode.name[0] }}</p>
                    </div>
                    <div class="mb-3">
                        <div class="form-field">
                            <label :for="id" class="form-label text-secondary">Matric</label>
                            <div class="mb-content">
                                <font-awesome-icon icon="fa-solid fa-fingerprint" class="icon text-primary"/>
                                <input type="number" name="matric" class="input-text text-secondary" :class="className" :id="id" v-model="form.matric">
                            </div>
                        </div>
                        <p :class="className" v-if="statusCode.matric">{{ statusCode.matric[0] }}</p>
                    </div>
                    <div class="mb-3">
                        <div class="form-field">
                            <label :for="id" class="form-label text-secondary">Speciality</label>
                            <div class="mb-content">
                                <font-awesome-icon icon="fa-solid fa-list-check" class="icon text-primary"/>
                                <input @input="checkInput" type="text" name="speciality" class="input-text text-secondary" :class="className" :id="id" v-model="form.speciality" placeholder="Student | Doctor">
                            </div>
                        </div>
                        <p :class="className" v-if="statusCode.speciality">{{ statusCode.speciality[0] }}</p>
                    </div>
                    <div class="mb-3">
                        <div class="form-field">
                            <label :for="id" class="form-label text-secondary">About</label>
                            <div class="mb-content">
                                <font-awesome-icon icon="fa-solid fa-circle-info" class="icon text-primary"/>
                                <input type="text" name="About" class="input-text text-secondary" :class="className" :id="id" v-model="form.about">
                            </div>
                        </div>
                        <p :class="className" v-if="statusCode.about">{{ statusCode.about[0] }}</p>
                    </div>
                    <div class="text-center"><span>Already a member?</span> <a href="/">Login</a></div><br>
                    <div class="d-grid gap-2">
                        <button ref="btnStudent" class="btn btn-primary disabled" type="submit">Student Sign up</button>
                        <button ref="btnDoctor" class="btn btn-primary disabled" type="submit">Doctor Sign up</button>
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
import images from '../images/signup.png'
export default {
    setup(){
        const router = useRouter()
        const store = useStore()
        let form = reactive({
            email: '',
            password: '',
            // password_confirmation:'',
            name: '',
            matric: '',
            speciality: '',
            about: ''

        });

        let btnDoctor = ref(null)
        let btnStudent = ref(null)
        // check input student /doctor
        const checkInput = (e) => {
            console.log(e)
            // switch (e.target.value) {
            //     case 'Doctor':
            //         btnStudent.value.classList.add('disabled')
            //         btnDoctor.value.classList.remove('disabled')
            //         break;
            //     case 'Student':
            //         btnStudent.value.classList.remove('disabled')
            //         btnDoctor.value.classList.add('disabled')
            //         break;
            //     default:
            //         btnStudent.value.classList.add('disabled')
            //         btnDoctor.value.classList.add('disabled')
            //         break;
            // }

            // changes
            if(e.target.value == "Doctor" || e.target.value == "doctor"){
                btnStudent.value.classList.add('disabled')
                btnDoctor.value.classList.remove('disabled')
            }else if(e.target.value == "Student" || e.target.value == "student"){
                btnStudent.value.classList.remove('disabled')
                btnDoctor.value.classList.add('disabled')
            }else{
                btnStudent.value.classList.remove('disabled')
                btnDoctor.value.classList.add('disabled')
            }
        }



        // console.log(form.speciality)

        let className = ref('');
        let statusCode = ref('')
        const signup = async() => {
            await axios.post('/api/register',form)
            .then((res)=>{
                console.log(res.data.data.token)
                console.log(res.data.data.user.name)
                statusCode.value = ''
                className.value = ''
                let defaultToken = {
                    bearerToken : res.data.data.token,
                    name : res.data.data.user.name,
                    speciality : res.data.data.user.speciality,
                    id : res.data.data.user.id
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
            checkInput,
            btnDoctor,
            btnStudent
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
</style>