import { reactive, ref} from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useStore } from 'vuex'
import $ from 'jquery'
import axios from 'axios'
const postBookSchedule = () => {
    const router = useRouter()
    const route = useRoute()
    const store = useStore()
    // let lat = document.querySelector('#lat').value
    let form = reactive({
        emergency_description: '',
        student_Id: store.getters.getTokenId,
        student_Name: store.getters.getTokenName,
        doctor_Id: 0,
        doctor_Name: '',
        status: 'pending',
        latitude:'',
        longitude:''      
    });

    let msgError = ref()
    let msgSuccess = ref()
    // set header
    const headers = {
            'Accept': 'application/vnd.api+json',
            'Content-Type': 'application/vnd.api+json',
            'Authorization': 'Bearer ' + store.getters.getToken
            }
    const emergencyAlert = async() => {
        console.log(form)
        if(form.emergency_description == ''){
            msgError.value = 'this is required'
            // console.log(store.getters.getTokenName)
        }else{
            msgError.value = ''
            await axios.post('/api/emergency',form,{headers})
            .then((res)=>{
                console.log(res)
                msgSuccess.value = 'Emergency alert sent to all the support team!. Please await their call.'
            })
            .catch((err)=>{
                console.log(err)
                msgSuccess.value = ''
            })
        }
        // // get time and date 
        // if(route.params.time == 'null' || route.params.date == 'null'){
        //     // let id = route.params.id
        //     router.push({name : 'Popup'})
        //     // router.back()
        // }else{
        //     alert('dwada')
        
        //     await axios.post('/api/bookschedule',form,{headers})
        //     .then((res)=>{
        //         console.log(res)
        //         // push login page by name
        //         router.push({name: "Student"})
        //     })
        //     //this is a problem after register
        //     .catch((err)=>{
        //         // router.push({name: "Student"})
        //         console.log(err)
        //     })
        // }
    }
    return { form, emergencyAlert, route, msgError, msgSuccess}
}

export default postBookSchedule;