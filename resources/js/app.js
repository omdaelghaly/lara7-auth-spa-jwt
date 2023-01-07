/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
 require('./bootstrap');

 // import $ from 'jquery'
 // window.jQuery = window.$ = $;
 
window.Vue = require('vue')

import store from './store/store'

import router from './router'





import mynavbar from './components/inc/Mynav.vue'








const app = new Vue({

    el: '#app',
    store,
    router,
       components:{
        mynavbar
    },
    
    data(){
        return{
              user:this.$store.getters.user,
              token:this.$store.getters.user.token,
              url:'',
            
        }
    },
    methods:{
      async refreshlogin()
        {
          var token=localStorage.getItem('tokenx');
                           
         await axios.post('api/autologin',{token:token}).then((response)=>{
                if(response.data.status=='success')
                {
                     this.$store.commit('setauth',response.data.data);
                      var userx=response.data.data;

                     if(this.$route.name!== 'callback_ve' && this.$route.name!== 'callback_pwd' )
                     {      
                        if(userx.verifyemail == 1)
                        {
                            this.$router.push('/');             
                        }else
                        {
                            this.$router.push('/sendverifyemail');             
                        }
                     }
                    
                }else{

                       localStorage.removeItem('tokenx');
                      if(this.$route.name!== 'login'&& this.$route.name!== 'callback_pwd')
                        {
                         this.$router.push('/login');
                        }
                }
            }).catch((errors)=>{
                  var err = errors.response.data.message ;
                  if(err){//unauthenticated  token expired
                      //localStorage.removeItem('tokenx')
                      if(this.$route.name!== 'login' && this.$route.name!== 'callback_pwd' )
                      {
                         this.$router.push('/login');
                      }
                }
          });  
        },
        autologin()
        {
          var token=localStorage.getItem('tokenx');
          // console.log(token);
                if(token)
                 {  
                   this.refreshlogin();  
                 }else{
                      if(this.$route.name!== 'login'&& this.$route.name!== 'callback_pwd')
                      {
                          this.$router.push('/login');
                      }

                }
        },

       

    },//end methods
    created()
    {
        this.autologin();    

    },//end created
  

    

});
