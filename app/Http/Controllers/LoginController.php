<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //註冊
    public function signup(){
        $user = new User([
            'name' => "karl2015y",
            'email' => "karl2015y@gmail.com",
            'password' => bcrypt('Aa3345678')
        ]);
        $user->save();
        return $user;
    }
    
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt(['email'=> $credentials['email'], 'password'=>$credentials['password'] ])) {
            // 认证通过．．．
            return "pass";
        }else{
            return "no";
        }
    }

    public function getMyData(Request $request){
        return response(
            $request->user()
        );
    }



        
    public function logout(Request $request)
    {
        Auth::logout();
        return "ok";
        // if () {
        //     return "ok";
        // }else{
        //     return "no logout";
        // }
    }
}
