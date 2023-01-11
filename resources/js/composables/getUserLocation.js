import { useStore } from "vuex";
import { ref,reactive, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import axios from 'axios'

const getUserLocation = ()=>{
    const store = useStore()
    const route = useRoute()
    const router = useRouter()
    const headers = {
        'Accept': 'application/vnd.api+json',
        'Content-Type': 'application/vnd.api+json',
        'Authorization': 'Bearer ' + store.getters.getToken
    }

    let student_Emergency = ref({});
    let mapData = ref({})
    // map credentials
    // const renderData = ref()
    let renderMap = ref()
    let renderMarker = ref()
    let renderAttr = ref()
    let renderTileUrls = ref()
    let renderTiles = ref()
    // let card_click = ref()
    let circle1 = ref(null)
    const getEmergency = async() => {
        await axios.get('/api/emergency',{headers})
        .then((res)=>{
            console.log(res)
            student_Emergency.value = res.data.data
            console.log(student_Emergency.value )

            student_Emergency.value.forEach(element => {
                console.log(element.student_Id)
                console.log(route.params.id)
                if(element.student_Id == route.params.id){
                    loadMap(element)
                    mapData.value = element
                }
            });
            
            // loadMap(student_Emergency.value)
        })
        .catch((err) => {
            console.log(err)
        })
    }
    onMounted(()=>{
        getEmergency()
        
    })
    
    const loadMap = (data) => {
        
        // problem here is once na madami na yung load ng request
        console.log(data)
        // rendered map
        renderMap = L.map('map').setView([14.6741293, 120.51129070000002], 12);
        renderMarker = L.marker([0, 0]).addTo(renderMap);
        renderAttr = '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        renderTileUrls = 'https://tile.openstreetmap.org/{z}/{x}/{y}.png'
        renderTiles = L.tileLayer(renderTileUrls, {renderAttr})
        renderTiles.addTo(renderMap)
        renderMarker.setLatLng([data.latitude, data.longitude])
        renderMarker.bindPopup(`<h5 class='bg-light text-danger'><b>${data.student_Name} requesting for emergency!.</b>.</h5>`).openPopup();
        // patient circle location
        circle1 = L.circle([data.latitude, data.longitude], {
            color: 'red',
            fillColor: '#d46675',
            fillOpacity: 0.2    ,
            radius: 100}).addTo(renderMap)
        
    } 

    const btn_Handle = async(student) => {
        console.log(student)
        let form = {
            "emergency_description" : student.emergency_description,
            'student_Name' : student.student_Name,
            'doctor_Id' : store.getters.getTokenId,
            'doctor_Name' : store.getters.getTokenName,
            'status' : 'approved',
            'id':student.student_Id
        }
        await axios.put('/api/emergency/'+student.student_Id,form,{headers})
        .then((res)=>{
            console.log(res)
            router.push({name : 'EmergencyRequest'})
            // console.log(store.getters.getTokenName)
        })
        .catch((err)=>{
            console.log(err)
        })
        }
    return {getEmergency, loadMap,mapData,btn_Handle}
}
export default getUserLocation;