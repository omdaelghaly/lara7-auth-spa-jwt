



<template>
  <div>

 <center>
     <h1  style="margin-top:30px ">
         welcome 
         <span style="color:green ">
                    {{user.name}}
         </span>

         in home page
     </h1>
   </center>

  </div>
</template>

<script>
export default {

};
</script>


<script>

export default {
props:['lang','mysite'],
     data(){
        return{
              user:this.$store.state.user,
              token:this.$store.state.user.token,
              msgg:'',
            
         }
    },
     methods:{
          me()
          {
           // window.axios.defaults.headers.common['Authorization'] = `Bearer `+this.token;

            axios.post('api/me',{token:this.token}).then((res)=>{
             // console.log(res.data.data);
              this.user=res.data.data;
            })
          },  
           
       isauth()
         {
            // if(!this.$store.state.user.token){
            //     this.$router.push('/login');
            // }else
            //  if(this.$store.getters.user.token && this.$store.getters.user.verifyemail !==1){
            //     this.$router.push('/sendverifyemail');             
            //} 
         },
        


           
       },//end methods
       created()
       {
        //this.me();
       },
         

      // beforeRouteEnter(to,from,next){
      // if (!this.$store.state.user)
      //   {next({ name: 'login' })
      //   } else{
      //    next()
      //  }
    // }, 
    

};
</script>