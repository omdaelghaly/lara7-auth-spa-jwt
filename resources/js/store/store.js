


import Vue from "vue"
import Vuex from "vuex"

Vue.use(Vuex);
  
const store = new Vuex.Store({
       state:{
           langx:'',
           currentpage:'',
           user:'',
           rooms:'my room',
           oldroom:'',
           streams:''
         },
       mutations: {
        setlang(state, lang) {
            state.langx = lang;
        },
        setauth(state, user) {
            state.user = user;
        },
         setvemail(state, num) {
            state.user.verifyemail = num ;
        },
     
    },
       getters:{
        lang:function(state){
            return state.langx;
        },
        currentpage:function(state){
            return state.currentpage;
        },
        user:function(state){
            return state.user;
        },
        oldroom:function(state){
            return state.oldroom;
        },
        rooms:function(state){
            return state.rooms;
        },
        myroom:function(state){
            return state.user.getroom.name;
        },
         stream:function(state){
            return state.streams;
        }

       }

});


export default store;