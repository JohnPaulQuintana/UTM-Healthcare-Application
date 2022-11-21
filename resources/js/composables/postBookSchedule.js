import { reactive, ref} from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useStore } from 'vuex'
import axios from 'axios'
const postBookSchedule = () => {
    const router = useRouter()
    const route = useRoute()
    const store = useStore()
    let form = reactive({
        details: '',
        status: 'pending',
        schedule_id: parseInt(route.params.id),
    });
    // set header
    const headers = {
            'Accept': 'application/vnd.api+json',
            'Content-Type': 'application/vnd.api+json',
            'Authorization': 'Bearer ' + store.getters.getToken
            }
    const consult = async() => {
        await axios.post('/api/bookschedule',form,{headers})
        .then((res)=>{
            console.log(res)
            // push login page by name
            router.push({name: "Student"})
        })
        //this is a problem after register
        .catch((err)=>{
            // router.push({name: "Student"})
            console.log(err)
        })
    }
    return { form, consult, route}
}

export default postBookSchedule;