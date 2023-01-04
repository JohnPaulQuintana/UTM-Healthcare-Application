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
    // checked booked status in db
    let bookUserStatus = ref(null)
    let checkMessageTime = ref()
    let checkMessageDate = ref()
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
                // i need to check the status code later
                msg.value = true
            })
            //this is a problem after register
            .catch((err)=>{
                console.log(err)
                msg.value = false
            })
            
        }
    }
    // check if already sent a booked status
    const checkIfAlreadyBooked = async()=>{
        await axios.get('/api/bookschedule/'+store.getters.getTokenId,{headers})
            .then((res)=>{
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
                    editRequest(checkMessageTime.value, checkMessageDate.value)
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
            console.log('pede magupdate')
        }else{
            console.log("bawal magupdate")
        }
    }

    // life cycle hooks
    onMounted(()=>{
        console.log('dapat paglogout masave yung booked status coming from db.')
       checkIfAlreadyBooked()
    //    editRequest()
    })
    return {sendNotif, setTime, data, msg, checkIfAlreadyBooked, bookUserStatus, editRequest}
}
export default sendRequest;