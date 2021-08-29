<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CheckShopIsLogin
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
        $DontCheckRoutes = ['ShopLoginPage'=>true, 'ShopLogin'=>true];
        $isLogin = Auth::viaRemember() || ($request->user() && $request->user()->Shop);
        $isDisable = $isLogin && $request->user()->Shop->status =='disable';
        if($isDisable){
            Auth::logout();
            $message_title = "權限錯誤";
            $message_type = "error";
            $message = "很抱歉，該帳戶已被後台封存，請聯絡管理員";
            return redirect()->route('ShopLoginPage')
                                ->with('message_title', $message_title)
                                ->with('message_type', $message_type)
                                ->with('message', $message);
        }
        if($DontCheckRoutes[$request->route()->getname()] ?? null){
            if($isLogin){
                $message_title = "登入成功";
                $message_type = "success";
                $message = "歡迎回來";
                return redirect()->route('ShopDatasPage')
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
                $message_title = "授權失敗";
                $message_type = "error";
                $message = "請登入後再重新嘗試";
                return redirect()->route('ShopLoginPage')
                                    ->with('message_title', $message_title)
                                    ->with('message_type', $message_type)
                                    ->with('message', $message);
            }
        }
    }
}
