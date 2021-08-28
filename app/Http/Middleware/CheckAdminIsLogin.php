<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminIsLogin
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
        $DontCheckRoutes = ['AdminLoginPage'=>true, 'AdminLogin'=>true];
        $isLogin = Auth::viaRemember() || ($request->user() && $request->user()->Staff);
        if($DontCheckRoutes[$request->route()->getname()] ?? null){
            if($isLogin){

                $message_title = "登入成功";
                $message_type = "success";
                $message = "歡迎回來";
                return redirect()->route('StaffsPage')
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
                return redirect()->route('AdminLoginPage')
                                    ->with('message_title', $message_title)
                                    ->with('message_type', $message_type)
                                    ->with('message', $message);
            }
        }
    }
}
