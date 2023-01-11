import { useStore } from "vuex";
import { ref,reactive, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import axios from 'axios'
const sendRequest = ()=> {
    const store = useStore()
    const route = useRoute()
    const router = useRouter()
    const headers = {
                'Accept': 'application/vnd.api+json',
                'Content-Type': 'application/vnd.api+json',
                'Authorization': 'Bearer ' + store.getters.getToken
            }
    
    let data = ref({})
    let setTime = ref(null)
    let msg = ref(null)
    let message = ref(null)
    // checked booked status in db
    let bookUserStatus = ref(null)
    let checkMessageTime = ref()
    let checkMessageDate = ref()
    let clearTimer = ref(null)
    let checkStatusData = ref({})
    let count = ref(0)
    // let bookedStatusChecked = ref({})
    const sendNotif = async() =>{
        console.log("Date : "+store.getters.getTokenDate)
        const dateConfig = store.getters.getTokenDate
        const timeConfig = store.getters.getTokenTime
        // optional
        const student_Name = store.getters.getTokenName
        const student_id = store.getters.getTokenId

        if(dateConfig == undefined || dateConfig == 0 || timeConfig == undefined || timeConfig == 0){
            setTime.value = false
        }else{
            data = {
                status: 'pending',
                schedule_id: parseInt(route.params.id),
                details : "optional",
                date : dateConfig,
                time : timeConfig,
            }
            setTime.value = true
            await axios.post('/api/bookschedule',data,{headers})
            .then((res)=>{
                console.log(res)
                if(res.data.message == "already booked"){
                    msg.value = false
                    message.value = res.data.message
                    let tokenData = {
                        bearerToken : store.getters.getToken,
                        name : store.getters.getTokenName,
                        speciality : store.getters.getTokenSpeciality,
                        id : store.getters.getTokenId,
                        date : 0,
                        time : 0,}
                    // restoring token in localstorage using vuex
                    store.dispatch('setToken', tokenData)
                }else if(res.data.message == "You already sent a request!"){
                    msg.value = false
                    message.value = res.data.message+'. Wait for the doctors response.'
                }else{
                    msg.value = true
                    let tokenData = {
                        bearerToken : store.getters.getToken,
                        name : store.getters.getTokenName,
                        speciality : store.getters.getTokenSpeciality,
                        id : store.getters.getTokenId,
                        date : res.data.data.attributes.date,
                        time : res.data.data.attributes.time,}
                    // restoring token in localstorage using vuex
                    store.dispatch('setToken', tokenData)
                    sendEmail(data.schedule_id)
                }
                // i need to check the status code later
               
                // request again for updating status
            })
            //this is a problem after register
            .catch((err)=>{
                console.log(err)
                msg.value = false
            })

            // // send request again
            // let form = {
            //     status: 'booked',
            //     schedule_id: parseInt(route.params.id),
            //     // details : "optional",
            //     date : dateConfig,
            //     time : timeConfig,
            // }
            // await axios.put('/api/sched/'+form.schedule_id,form,{headers})
            // .then((res)=>{
            //     console.log(res)
            //     // console.log(store.getters.getTokenName)
            // })
            // .catch((err)=>{
            //     console.log(err)
            // })
            
        }
    }
    // check if already sent a booked status
    const checkIfAlreadyBooked = async()=>{
        await axios.get('/api/bookschedule/'+store.getters.getTokenId,{headers})
            .then((res)=>{
                console.log(res.data.data.length)
                count.value = res.data.data.length
                bookUserStatus.value = res.data.data;
                bookUserStatus.value.forEach(element => {
                    if(element.time == store.getters.getTokenTime){
                        console.log('this time is already booked : '+store.getters.getTokenTime)
                        // checkMessages.value = {'time' : 'this time is already booked : '+store.getters.getTokenTime}
                        checkMessageTime.value = 'this time is already booked : '+store.getters.getTokenTime
                    }
                    if(element.date == store.getters.getTokenDate){
                        console.log('this date is already booked : '+store.getters.getTokenDate)
                        checkMessageDate.value = 'this date is already booked : '+store.getters.getTokenDate
                    }
                    // pass value message
                    // editRequest(checkMessageTime.value, checkMessageDate.value)
                });
            })
            //this is a problem after register
            .catch((err)=>{
                console.log(err)
            })
    }
    // edit Request
    const editRequest = async(paramsTime,paramsDate) => {
        console.log("time : "+paramsTime)
        console.log("Date : "+paramsDate)
        // one true time or date 
        if(paramsDate == undefined || paramsTime == undefined){
            console.log("bawal magupdate")
        }else{
            console.log("pede magupdate")
            let form = {
                from: 'student',
                status : 'pending',
                details : 'optional',
                student_id: store.getters.getTokenId,
                date : paramsDate,
                time : paramsTime,
            }
            await axios.put('/api/bookschedule/'+form.student_id,form,{headers})
            .then((res)=>{
                console.log(res)
                let tokenData = {
                    bearerToken : store.getters.getToken,
                    name : store.getters.getTokenName,
                    speciality : store.getters.getTokenSpeciality,
                    id : store.getters.getTokenId,
                    date : res.data.date,
                    time : res.data.time,}
                    // restoring token in localstorage using vuex
                    store.dispatch('setToken', tokenData)

                // push router
                // router.push({path:'/profile_info2/'+route.params.id})
            })
            .catch((err)=>{
                console.log(err)
            })
        }
        onMounted(()=>{
            console.log('dwdwaddwadwad')
            clearTimer.value=setInterval(checkStatus,3000)
        })
    }

    // delete request
    const deleteRequest = async(student_id) => {
        console.log("destroy record")
            await axios.delete('/api/bookschedule/'+student_id,{headers})
            .then((res)=>{
                console.log(res)
                let tokenData = {
                    bearerToken : store.getters.getToken,
                    name : store.getters.getTokenName,
                    speciality : store.getters.getTokenSpeciality,
                    id : store.getters.getTokenId,
                    date : 0,
                    time : 0,}
                // restoring token in localstorage using vuex
                store.dispatch('setToken', tokenData)
            })
            .catch((err)=>{
                console.log(err)
            })
    }

    // check status
    const checkStatus = async()=>{
        await axios.get('/api/checkStatus/'+store.getters.getTokenId,{headers})
        .then((res)=>{
            console.log(res.data)
            checkStatusData.value = res.data
            console.log(checkStatusData.length)
        })
        .catch((err)=>{
            console.log(err)
            clearInterval(clearTimer.value)
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

    // life cycle hooks
    onMounted(()=>{
        console.log('dapat paglogout masave yung booked status coming from db.')
       checkIfAlreadyBooked()
       checkStatus()
    //    editRequest()
    })
    return {count,sendNotif,checkStatusData,checkStatus, setTime, data, msg, message, checkIfAlreadyBooked, bookUserStatus, editRequest,deleteRequest}
}
export default sendRequest;