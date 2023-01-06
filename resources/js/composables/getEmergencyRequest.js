import { useStore } from "vuex";
import { ref,reactive, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import axios from 'axios'
import { map } from "jquery";

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
    // map credentials
    const renderData = ref()
    let renderMap = ref()
    let renderMarker = ref()
    let renderAttr = ref()
    let renderTileUrls = ref()
    let renderTiles = ref()
    let circle1 = ref(null)
    const getEmergency = async() => {
        await axios.get('/api/emergency',{headers})
        .then((res)=>{
            // console.log(res)
            student_Emergency.value = res.data.data
            console.log(student_Emergency.value )
            loadMap(student_Emergency.value)
        })
        .catch((err) => {
            console.log(err)
        })
    }
    onMounted(()=>{
        getEmergency()
        
    })

    // emergency click
   const clickEvents = (student_Id) => {
        if(student_Id){
          // uncomment this after you slove the ratings problem
          router.push('/emergency-details/'+student_Id) 
        }
      }             
    const loadMap = (data) => {
        // problem here is once na madami na yung load ng request
        console.log(data[0].latitude)
        // rendered map
        renderMap = L.map('map').setView([14.6741293, 120.51129070000002], 12);
        renderMarker = L.marker([0, 0]).addTo(renderMap);
        renderAttr = '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        renderTileUrls = 'https://tile.openstreetmap.org/{z}/{x}/{y}.png'
        renderTiles = L.tileLayer(renderTileUrls, {renderAttr})
        renderTiles.addTo(renderMap)
        renderMarker.setLatLng([data[0].latitude, data[0].longitude])
        renderMarker.bindPopup("<h4 class='bg-light text-danger'><b>User location found!.</b>.</h4>").openPopup();
        // patient circle location
        circle1 = L.circle([data[0].latitude, data[0].longitude], {
            color: 'red',
            fillColor: '#d46675',
            fillOpacity: 0.2    ,
            radius: 100}).addTo(renderMap)
        
        } 
        // circle1.addTo(renderMap)

    // const clickMap = () => {
    //     // click map
    //     renderMap.on('click',(e)=>{
    //         console.log(e)
    //         console.log('click map')
    //     })
    // }
    return {getEmergency, student_Emergency,clickEvents,loadMap}
}

export default getEmergencyRequest;