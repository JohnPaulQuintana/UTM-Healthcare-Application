<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6 card">
                <!-- {{ form }} -->
                <form @submit.prevent="resetPass">
                    <div class="mb-3">
                        <h1 class="text-center">Create New Password</h1>    
                    </div>
                    <hr/>
                    <div class="mb-3">
                        <div class="form-field">
                            <label for="newPassword" class="form-label text-secondary">New Password</label>
                            <div class="mb-content">
                                <font-awesome-icon icon="fa-solid fa-at" class="icon text-secondary"/>
                                <input type="password" class="input-text text-secondary" :class="className"  v-model="form.password">
                            </div>
                        </div>
                        <p :class="className" v-if="statusCode.password">{{ statusCode.password }}</p>
                    </div>
                    <div class="mb-3">
                        <div class="form-field">
                            <label for="confirmedPassword" class="form-label text-secondary">Confirm-Password</label>
                            <div class="mb-content">
                                <font-awesome-icon icon="fa-solid fa-at" class="icon text-secondary"/>
                                <input type="password" class="input-text text-secondary" :class="className"  v-model="form.password_confirmation">
                            </div>
                        </div>
                        <p :class="className" v-if="statusCode.password">{{ statusCode.password }}</p>
                    </div>
                    <!-- <div class="text-center text-secondary"><span>Enter your email and we will send a password reset link</span></div><br> -->
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Reset Password</button>
                        <!-- <div class="text-center"><span>New to BetterHealth? </span><a href="/register"> Sign Up</a></div> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    import { reactive, ref } from 'vue'
    import { useRoute, useRouter } from 'vue-router';
    export default {
        setup () {
            
            const router = useRoute()
            const route = useRouter()
            // console.log( route.params );
            // let id = ref(route.params.id);
            let statusCode = ref('')
            let form = reactive({
                token: router.params.token,
                password: '',
                password_confirmation: '',
            });
            let className = ref('text-secondary');





            const resetPass = async() => {
            // set header
            const headers = {
                'Accept': 'application/vnd.api+json',
                'Content-Type': 'application/vnd.api+json',
                }
            await axios.post("/api/update/"+router.params.id, form, {headers})
            .then((res)=>{
                console.log(res)
                statusCode.value = ''
                className.value = ''
                route.push({ name: 'Login' });
            })
            //this is a problem after register
            .catch((err)=>{
                console.log(err)
                if(err){
                    console.log('yes')
                    statusCode.value = err.response.data.errors  
                    className.value = 'text-danger error'
                }else{
                    statusCode.value = err
                }
                
            })
        }
        // const update = async() => {
        //     await
        // }
        return {
            form,
            className,
            resetPass,
            statusCode
            

        }
        }
    }
</script>

<style scoped>
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