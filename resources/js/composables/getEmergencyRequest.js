import { useStore } from "vuex";
import { ref,reactive, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import axios from 'axios'

const getEmergencyRequest = () => {
    const store = useStore()
    const route = useRoute()
    const router = useRouter()
    const headers = {
        'Accept': 'application/vnd.api+json',
        'Content-Type': 'application/vnd.api+json',
        'Authorization': 'Bearer ' + store.getters.getToken
    }

    let student_Emergency = ref({})
    const getEmergency = async() => {
        await axios.get('/api/emergency',{headers})
        .then((res)=>{
            // console.log(res)
            student_Emergency.value = res.data.data
            console.log(student_Emergency.value )
        })
        .catch((err) => {
            console.log(err)
        })
    }
    onMounted(()=>{
        getEmergency()
    })
    return {getEmergency, student_Emergency}
}

export default getEmergencyRequest;