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
            // notify credentials
            let notifyCred = {
                doctor_id:res.data.schedule_id,
                doctor_name:res.data.details,
                student_id:res.data.user_id,
                // student_name:store.getters.getTokenName,
                // student_booked_date:store.getters.getTokenDate,
                // student_booked_time:store.getters.getTokenTime
            }
            sendEmailStudent(form.student_id)
             
            userNotify(notifyCred)
            // console.log(store.getters.getTokenName)
            router.push({ name: 'Request' });
        })
        .catch((err)=>{
            console.log(err)
        })
    }
    // send notif
    const userNotify = async(data)=>{
        await axios.post('/api/fireevent/'+data.id,{data},{headers})
        .then((res)=>{
            console.log(res)
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
            let notifyCred = {
                doctor_id:res.data.schedule_id,
                doctor_name:res.data.details,
                student_id:res.data.user_id,
                // student_name:store.getters.getTokenName,
                // student_booked_date:store.getters.getTokenDate,
                // student_booked_time:store.getters.getTokenTime
            }
            userNotify(notifyCred)
            sendEmailStudent(form.student_id)
            // console.log(store.getters.getTokenName)
            router.push({ name: 'Doctor' });
        })
        .catch((err)=>{
            console.log(err)
        })
    }
     // sendEmail
     const sendEmailStudent = async(doctor_id)=>{
        await axios.get('/api/sendToStudent/'+doctor_id,{headers})
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