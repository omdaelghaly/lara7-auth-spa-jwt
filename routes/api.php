<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register','Api\Auth\Registercontroller@register')->name('register');
Route::post('/RTregister','Api\Auth\Registercontroller@RTregister')->name('RTregister');

Route::post('/login','Api\Auth\Logincontroller@login')->name('login');
Route::post('/RTlogin','Api\Auth\Logincontroller@RTlogin')->name('RTlogin');
//password verify
Route::post('/pwdsendemail', 'Api\Auth\Forgetpwdcontroller@pwdsendemail');
Route::post('callback_pwd_check', 'Api\Auth\Forgetpwdcontroller@callback_pwd_check')->name('callback_pwd_check');
Route::post('savenewpwd', 'Api\Auth\Forgetpwdcontroller@savenewpwd')->name('savenewpwd');


Route::group(['middleware'=>'auth:api'], function(){

    Route::get('logout', 'Api\Auth\Logincontroller@logout');
    Route::post('/autologin', 'Api\Auth\Logincontroller@autologin');
    Route::post('refresh', 'Api\Auth\Logincontroller@refresh');
    Route::post('me', 'Api\Auth\Logincontroller@me');
    Route::post('sendverifyemail', 'Api\Auth\Verifyusercontroller@sendverifyemail');
    Route::post('callback_ve', 'Api\Auth\Verifyusercontroller@callback_ve')->name('callback_ve');



});

 // Route::get('callback_ve/e/{email}/t/{token}', 'Api\Auth\verifyusercontroller@callback_ve');
