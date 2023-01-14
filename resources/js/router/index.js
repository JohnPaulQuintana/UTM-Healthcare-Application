import { createRouter, createWebHistory } from 'vue-router'
// import Navbar from '../navbar/Navbar.vue'
import Login from '../pages/Login.vue'
import Register from '../pages/register.vue'
import Doctor from '../dashboard/Doctor.vue'
import Student from '../dashboard/Student.vue'
import store from '../store/index.js'
import ForgotPassword from '../pages/ForgotPassword.vue'
import ResetPassword from '../pages/ResetPassword.vue'
import Success from '../pages/Success.vue'
import Schedule from '../pages/Schedule.vue'
import Request from '../pages/Request.vue'
import Book from '../pages/Book.vue'
import Profile from '../pages/Profile.vue'
import ProfileInfo from '../pages/ProfileInfo.vue'
import Rating from '../pages/Rating.vue'
import NotAuthorized from '../pages/NotAuthorized.vue'
import PopUp from '../pages/PopUp.vue'
import RequestStatus from '../pages/RequestStatus.vue'
import Emergency from '../pages/Emergency.vue'
import EmergencyRequest from '../pages/EmergencyRequest.vue'
import EmergencyDetails from '../pages/EmergencyDetails.vue'
import RequestSuccess from '../pages/RequestSuccess.vue'
const routes = [
    {
        path: '/',
        name: 'Login',
        component: Login,
        // meta: {title : 'Login'}
        meta:{
            requiresAuth:false
        },
    },
    {
        path: '/register',
        name: 'Register',
        component: Register,
        // meta: {title : 'Register'}
        meta:{
            requiresAuth:false
        },
    },
    {
        path: '/forgot_password',
        name: 'Forgot_Password',
        component: ForgotPassword,
        // meta: {title : 'User'}
        meta:{
            requiresAuth:false
        },
    },
    {
        path: '/reset-password/:token/:id',
        name: 'Reset_Password',
        component: ResetPassword,
        // meta: {title : 'User'}
        meta:{
            requiresAuth:false
        },
    },
    {
        path: '/success',
        name: 'Success',
        component: Success,
        // meta: {title : 'User'}
        meta:{
            requiresAuth:false
        },
    },
    {
        path: '/student',
        name: 'Student',
        component: Student,
        // meta: {title : 'User'}
        meta:{
            requiresAuth:true
        },
    },
    {
        path: '/book/:id/:time/:date',
        name: 'Book',
        component: Book,
        // meta: {title : 'User'}
        meta:{
            requiresAuth:true
        },
    },
    {
        path: '/doctor',
        name: 'Doctor',
        component: Doctor,
        // meta: {title : 'User'}
        meta:{
            requiresAuth:true
        },
    },
    {
        path: '/schedule',
        name: 'Schedule',
        component: Schedule,
        // meta: {title : 'User'}
        meta:{
            requiresAuth:true
        },
    },
    {
        path: '/request',
        name: 'Request',
        component: Request,
        // meta: {title : 'User'}
        meta:{
            requiresAuth:true
        },
    },
    {
        path: '/profile',
        name: 'Profile',
        component: Profile,
        // meta: {title : 'User'}
        meta:{
            requiresAuth:true
        },
    },
    {
        path: '/profile_info/:id',
        name: 'Profile_Info',
        component: ProfileInfo,
        // meta: {title : 'User'}
        meta:{
            requiresAuth:true
        },
    },
    {
        path: '/rating/:id',
        name: 'Rating',
        component: Rating,
        // meta: {title : 'User'}
        meta:{
            requiresAuth:true
        },
    },
    {
        path: '/not-authorized-access',
        name: 'Access-denied',
        component: NotAuthorized,
        meta:{
            requiresAuth:false
        },
    },
    {
        path: '/popup',
        name: 'Popup',
        component: PopUp,
        meta:{
            requiresAuth:false
        },
    },
    {
        path: '/request-status',
        name: 'RequestStatus',
        component: RequestStatus,
        meta:{
            requiresAuth:true
        },
    },
    {
        path: '/emergency',
        name: 'Emergency',
        component: Emergency,
        meta:{
            requiresAuth:true
        },
    },
    {
        path: '/emergency-request',
        name: 'EmergencyRequest',
        component: EmergencyRequest,
        meta:{
            requiresAuth:true
        },
    },
    {
        path: '/emergency-details/:id',
        name: 'EmergencyDetails',
        component: EmergencyDetails,
        meta:{
            requiresAuth:true
        },
    },
    {
        path: '/requestSuccess',
        name: 'RequestSuccess',
        component: RequestSuccess,
        meta:{
            requiresAuth:true
        },
    },

];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
});

// token
let defaultToken = {
    bearerToken : 0,
    name : 0,
    speciality : 0,
}

// redirect user
router.beforeEach(async(to, from,next)=>{
    // auththentication is true and localStorage is not set
    if(to.meta.requiresAuth && store.getters.getToken == 0 || store.getters.getToken == 'undefined'){
        console.log(store.getters.getToken)
        // return { name : 'Login' } 
        next({name : "Login"})   
         
    }else{
        // next()
        console.log('resgister')
        next()
        // next()
    }
    // // // problem is doctor redirected to a student pages
    // if(to.meta.requiresAuth == false && store.getters.getToken != 0){
    //     if(store.getters.getTokenSpeciality == 'Doctor' || store.getters.getTokenSpeciality == 'doctor'){
    //         // return { name : 'Doctor' }
    //         console.log('Doctor')
    //         next({name : "Doctor"})
    //     }else{
    //         next()
    //     }
    //     if (store.getters.getTokenSpeciality == 'Student' || store.getters.getTokenSpeciality == 'student') {
    //         console.log('student')
    //         next({name : "Student"})
    //         // return { name : 'Student' }
    //     }else{
    //         next()
    //     }
        
    
    // }
     
    // retunf false after the login attemp
    

    // if(to.meta.requiresAuth && store.getters.getTokenSpeciality != 0 && store.getters.getTokenSpeciality == "Doctor"){
    //     console.log('doctor')
    //     return { name : 'Doctor' }; 
    // }
   
    
})

export default router;