


<template>
    <div>
<!--  -->
    

<nav class="navbar navbar-expand-lg navbar-light bg-light  p-0 m-0">
    <router-link to='/' class="navbar-brand"> {{this.mysite}} </router-link>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
          <router-link to='/' class="nav-link" > {{this.$store.getters.lang.home}} </router-link>
      </li>
   
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a to="/"   class="dropdown-item">Home</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item active">
          <router-link to='/my-profile' class="nav-link" > {{this.$store.getters.lang.home}} </router-link>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">


     <li class="nav-item active " v-if="! this.$store.getters.user.token" >
          <router-link to='/login' class="nav-link" > {{this.$store.getters.lang.login}}  </router-link>
      </li>

      <li class="nav-item active mr-5" v-if="! this.$store.getters.user.token" >
           <router-link to='/register' class="nav-link"  > {{this.$store.getters.lang.register}} </router-link>
      </li>
       
     <li class="nav-item dropdown mr-5" v-if="this.$store.getters.user.token" >
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <span>  {{this.$store.getters.user.name}} </span>

         <img style="width:30px;height:30px;border-radius:30px ;" src="" id="profileimage">
        

        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a to="/"   class="dropdown-item">Home</a>
          <a class="dropdown-item" href="#">Aaction</a>
          <div class="dropdown-divider"></div>
            <a @click.prevent="logout"  class="dropdown-item" > {{this.$store.getters.lang.logout}} </a> 
          </div>
      </li> 
     
     
    </ul>

    <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
     
    </form> -->
  </div>
</nav>




 
<!--  -->
    </div>
</template>

<style >
 
</style>

<script>

export default {
props:['lang','mysite'],
     data(){
        return{
              user:'',
              token:'',
            
         }
    },
     methods:{
        setlang(){
          this.$store.commit('setlang',this.lang);
         },
         logout()
         {
         window.axios.defaults.headers.common['Authorization'] = `Bearer `+this.$store.getters.user.token;

            axios.get('api/logout').then((res)=>{
             // console.log(res.data.status);
              this.$store.commit('setauth','');
              localStorage.removeItem('tokenx');
              this.$router.push("/login");
            })
         }    
           
  
           
       },//end methods
       created(){
        this.setlang();
       },
     
  


};
</script>