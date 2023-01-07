<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Loginreq;
use App\Http\Requests\Registerreq;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Logincontroller extends Controller
{


    public function __construct() {
        $this->middleware('auth:api',['except'=>['newautologin','login','RTlogin','autologin']  ]);
    }
//login page 
// public function loginpage(){
//     if(auth()->user()){
//         return redirect()->route('home');
//     }
//     return view('auth.login');
// }



    
    public function login(Loginreq $request)
    {
          $user = User::where('email', $request->email)->first();
           
         if($user){
        //check password
                if(Hash::check($request->password, $user->password))
                 {//pass true
                       if($token = auth('api')->attempt(array('email' => $request->email, 'password' => $request->password)))
                       {
                             $user->token = $token;
                             $user->isAuthenticated ='true';
                            return response()->json([
                            'status'=>'success',
                            'data' =>  $user,

                            ]);   
                        
                        }
                  }else{//pass false 
                          return response()->json([
                           'status'=>'errors',
                            'password'=>[ __('myauth.errorpassword')],
                       ]);
                   }  
         

            }else{
                  return response()->json([
                    'status'=>'errors',
                    'email'=>[ __('myauth.emailnotexist')],
                    ]);
            };

                  // return response()->json([
                  //   'status'=> 'success',
                  //    'data'=>$request->all() ]); 



     }//endlogin


     protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }


    
   //realtime register validate request
    public function RTlogin(Loginreq $request)
    {
        return response()->json(['status'=>'ok']);
    }
        
   



####################################################################################
//logout

    public function logout() {
     
         auth('api')->logout();
        return response()->json(['status' => 'ok']); 
    }



  ///////////////////
    public function me(Request $request)
    {
       $token = $request->token;
       $user = auth('api')->user();
       $user->token = $token;
      // $user->isAuthenticated ='true';

        return response()->json(['data'=>$user]);
    }

/////////

     public function autologin(Request $request)
    {
       $token = $request->token;
       $user = auth('api')->user();
       $user->token = $token;
       //$user->isAuthenticated ='true';
       if($user)
       {
              return response()->json(['status'=>'success' , 'data'=>$user]);
       }else{ //token expire
               return response()->json(['status'=>'error' , 'data'=>'token expired']);
       }

    }





}



///////////////////////////////////////

