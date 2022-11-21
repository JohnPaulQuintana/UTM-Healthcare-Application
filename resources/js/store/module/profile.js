import { createStore } from "vuex"
import $ from 'jquery'
const store = createStore({

    state: {
        // define variables
        // token : JSON.parse(localStorage.getItem('token')) || 0
        profileInfo : "No Data Available!"
    },

    mutations: {
        //  update variable value
        // UPDATE_TOKEN(state,payload){
        //     state.token = payload
        // }

    },

    actions: {
        // action to be performed
        // setToken(context,payload){
        //     localStorage.setItem('token', JSON.stringify(payload))
        //     context.commit('UPDATE_TOKEN',payload)
        // },
        // removeToken(context, payload){
        //     localStorage.removeItem('token')
        //     localStorage.setItem('token',JSON.stringify(payload))
        //     context.commit('UPDATE_TOKEN', payload)
        // }
        setProfileData(context, payload){
            $.ajax({
                url : ''
            })
        }
    },

    getters: {
        // get state variable value
        // getToken: function(state){
        //     return state.token.bearerToken;
        // },
        // getTokenName: function(state){
        //     return state.token.name;
        // },
        // getTokenSpeciality: function(state) {
        //     return state.token.speciality;
        // }
    }
})

export default store;