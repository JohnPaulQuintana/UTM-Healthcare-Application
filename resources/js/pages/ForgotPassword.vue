<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6 card">
                <!-- {{ form }} -->
                <form @submit.prevent="forgotPassword">
                    <div class="mb-3">
                        <h1 class="text-center">Forgot Password</h1>
                        <!-- <h1><i class="fas fa-spinner fa-pulse"></i></h1> -->
                    </div>
                    <hr/>
                    <div class="mb-3">
                        <div class="form-field">
                            <label for="id" class="form-label text-secondary">Email ID</label>
                            <div class="mb-content">
                                <font-awesome-icon icon="fa-solid fa-at" class="icon text-secondary"/>
                                <input   type="email" name="email" class="input-text text-secondary" :class="className"  v-model="form.email">
                            </div>
                        </div>
                        <h3 class="text-center text-success" v-if="loading">Your link is on its way....</h3>
                        <p :class="className" v-if="statusCode.message">{{ statusCode.message }}</p>

                    </div>
                   
                    <div class="text-center text-secondary"><span>Enter your email and we will send a password reset link</span></div><br>
                    <div class="d-grid gap-2">
                        <button @click="loadingAnimation" class="btn btn-primary" type="submit">Reset Password</button>
                        <!-- <div class="text-center"><span>New to BetterHealth? </span><a href="/register"> Sign Up</a></div> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    import { reactive, ref } from 'vue'
    import { useRouter } from 'vue-router';
    export default {
        setup () {
            // const router = useRoute()
            const router = useRouter()
            // console.log( route.params.token );
            let form = reactive({
            email: '',

            });
            let statusCode = ref('')
            let className = ref('text-secondary');
            let loading = ref('');
            // send request form
            const forgotPassword = async () =>{
                 // set header
                const headers = {
                    'Accept': 'application/vnd.api+json',
                    'Content-Type': 'application/vnd.api+json'
                    }
                await axios.post('/api/forgot-password',form, {headers})
                .then((res)=>{
                    loading.value = true
                    console.log(res)
                    statusCode.value = ''
                    className.value = ''
                    router.push({ name: 'Success'})
                })
                .catch((err)=>{
                    if(err){
                        console.log(err)
                        statusCode.value = err.response.data
                        loading.value = false
                        className.value = 'text-danger error'
                    }
                   
                })
            }

            function loadingAnimation(){
                loading.value = true                
            }
        return {
            form,
            className,
            forgotPassword,
            statusCode,
            loadingAnimation,
            loading

        }
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