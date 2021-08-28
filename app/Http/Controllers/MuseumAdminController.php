<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MuseumAdminController extends Controller
{
    public function loginPage(){
        return view('phone.museum.LoginPage');
    }
    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'email.required' => ':attribute為必填',
            'email.email' => ':attribute格式錯誤',
            'password.required' => ':attribute為必填',
        ],[
            'email'=>'電子信箱',
            'password' => '密碼',
        ]);
    
    
        $remember_me = $request->has('remember_me') ? true : false;

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember_me)){
            $message_title = "登入成功";
            $message_type = "success";
            $message = "歡迎回來";
            return redirect()->route('MuseumDatasPage')
                                ->with('message_title', $message_title)
                                ->with('message_type', $message_type)
                                ->with('message', $message);
        }else{
            $message_title = "登入失敗";
            $message_type = "error";
            $message = "帳號或密碼錯誤";
            return redirect()->route('MuseumLoginPage')
                                ->with('message_title', $message_title)
                                ->with('message_type', $message_type)
                                ->with('message', $message);
        }

        
    }
    public function MuseumDatasPage(Request $request){
        $datas = [
            'museum' => $request->user()->Museum
        ];
        return view('phone.museum.MuseumDatasPage', $datas);
    }
    public function MuseumShopsPage(Request $request){
        $datas = [
            'shops' => $request->user()->Museum->Shops
        ];
        return view('phone.museum.MuseumShopsPage', $datas);
    }
    public function MuseumShopDatasPage($shop_id, Request $request){
        $datas = [
            'shop' => $request->user()->Museum->Shops->where('id',$shop_id)->first()
        ];
        return view('phone.museum.MuseumShopDatasPage', $datas);
    }
    public function MuseumShopHistoryPage($shop_id, Request $request){
        $datas = [
            'PayPointRecords' => $request->user()->Museum->Shops->where('id',$shop_id)->first()->PayPointRecord
        ];
        return view('phone.museum.MuseumShopHistoryPage', $datas);
    }
}
