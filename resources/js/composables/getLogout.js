import { useStore } from 'vuex'
import { useRouter } from 'vue-router'
import { reactive, ref } from 'vue'
const getLogout = () => {
    const router = useRouter()
    const store = useStore()
    // const count = ref(null)
    let defaultToken = {
        bearerToken : 0,
        name : 0,
        speciality : 0,
        time : store.getters.getTokenTime,
        date : store.getters.getTokenDate
    }
    // console.log(this.count.value)
    function logout(){
        store.dispatch('removeToken',defaultToken)
        router.push({name : "Login"})
    }

    return {logout}
}

export default getLogout;