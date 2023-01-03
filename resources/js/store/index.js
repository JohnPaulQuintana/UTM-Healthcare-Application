import { createStore } from "vuex"

const store = createStore({

    state: {
        // define variables
        token : JSON.parse(localStorage.getItem('token')) || 0,
        book : JSON.parse(localStorage.getItem('bookInfo')) || 0
    },

    mutations: {
        //  update variable value
        UPDATE_TOKEN(state,payload){
            state.token = payload
        },

        // update book
        UPDATE_BOOK(state,payload){
            state.book = payload
        }
    },

    actions: {
        // action to be performed
        setToken(context,payload){
            localStorage.setItem('token', JSON.stringify(payload))
            context.commit('UPDATE_TOKEN',payload)
        },
        removeToken(context, payload){
            localStorage.removeItem('token')
            localStorage.setItem('token',JSON.stringify(payload))
            context.commit('UPDATE_TOKEN', payload)
        },
        setBook(context,payload){
            localStorage.setItem('bookInfo', JSON.stringify(payload))
            context.commit('UPDATE_BOOK')
        }
    },

    getters: {
        // get state variable value
        getToken: function(state){
            return state.token.bearerToken;
        },
        getTokenName: function(state){
            return state.token.name;
        },
        getTokenSpeciality: function(state) {
            return state.token.speciality;
        },
        getTokenId: function(state) {
            return state.token.id;
        },
        getTokenDate: function(state) {
            return state.token.date;
        },
        getTokenTime: function(state) {
            return state.token.time;
        },
        // getBOOK
        getUpdated:function(state){
            return state.token.updated;
        }
    }
})

export default store;