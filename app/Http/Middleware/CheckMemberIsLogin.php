<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckMemberIsLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $StorekRoutes = [
            'VouchersStorePage'=>true,
            'VoucherStorePage'=>true,
        ];
        if($StorekRoutes[$request->route()->getname()] ?? null){
            return $next($request);
        }

        
        $DontCheckRoutes = [
            'MemberLoginPage'=>true, 
            'MemberLogin'=>true,
            'MemberForgetPassPage'=>true,
            'MemberForgetPass'=>true,
            'MemberRegisterPage'=>true,
            'MemberRegister'=>true,
         
        ];
        $isLogin = Auth::viaRemember() || ($request->user() && $request->user()->Member);
        if($DontCheckRoutes[$request->route()->getname()] ?? null){
            if($isLogin){

                $message_title = "登入成功";
                $message_type = "success";
                $message = "歡迎回來";
                return redirect()->route('MemberPointPage')
                                    ->with('message_title', $message_title)
                                    ->with('message_type', $message_type)
                                    ->with('message', $message);
            }else{
                return $next($request);
            }
        }else{
            if($isLogin){
                return $next($request);
            }else{
                $message_title = "已登出";
                $message_type = "error";
                $message = "若需進行操作，請再次登入後重新嘗試";
                return redirect()->route('MemberLoginPage')
                                    ->with('message_title', $message_title)
                                    ->with('message_type', $message_type)
                                    ->with('message', $message);
            }
        }
    }
}
