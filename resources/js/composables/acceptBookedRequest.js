import { useStore } from "vuex";
import { ref,reactive, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import axios from 'axios'
const acceptBookedRequest =() => {
    const store = useStore()
    const route = useRoute()
    const router = useRouter()
    const headers = {
                'Accept': 'application/vnd.api+json',
                'Content-Type': 'application/vnd.api+json',
                'Authorization': 'Bearer ' + store.getters.getToken
            }

    // accept
    const booked = async(id) => {
         // send request again
         let form = {
            from: 'doctor',
            status: 'booked',
            student_id: parseInt(id),
            details : store.getters.getTokenName,
            // date : dateConfig,
            // time : timeConfig,
        }
        await axios.put('/api/bookschedule/'+form.student_id,form,{headers})
        .then((res)=>{
            console.log(res)
            sendEmail(form.student_id)
            // console.log(store.getters.getTokenName)
            router.push({ name: 'Doctor' });
        })
        .catch((err)=>{
            console.log(err)
        })
    }
    // reject request
    const rejectBooked = async(id) => {
        // send request again
        let form = {
            status: 'rejected',
            student_id: parseInt(id),
            details : store.getters.getTokenName,
            // date : dateConfig,
            // time : timeConfig,
        }
        await axios.put('/api/bookschedule/'+form.student_id,form,{headers})
        .then((res)=>{
            console.log(res)
            // console.log(store.getters.getTokenName)
            router.push({ name: 'Doctor' });
        })
        .catch((err)=>{
            console.log(err)
        })
    }
     // sendEmail
     const sendEmail = async(doctor_id)=>{
        await axios.get('/api/send/'+doctor_id,{headers})
        .then((res)=>{
            console.log(res.data)
            // checkStatusData.value = res.data
        })
        .catch((err)=>{
            console.log(err)
            // clearInterval(clearTimer.value)
        })
    }
    return {booked,rejectBooked }
}

export default acceptBookedRequest;