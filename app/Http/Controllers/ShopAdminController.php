<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\PayPointRecord;


class ShopAdminController extends Controller
{
    public function loginPage(){
        return view('phone.shop.LoginPage');
    }
    public function login(Request $request){
        $this->validate($request, [
            'phone' => 'required',
            'password' => 'required',
        ],[
            'phone.required' => ':attribute為必填',
            'password.required' => ':attribute為必填',
        ],[
            'phone'=>'連絡電話',
            'password' => '密碼',
        ]);
    
        $email = $request->input('phone').'@shop.museum.tw';
    
        $remember_me = $request->has('remember_me') ? true : false;
        if (Auth::attempt(['email' => $email, 'password' => $request->input('password')], $remember_me)){
            $message_title = "登入成功";
            $message_type = "success";
            $message = "歡迎回來";
            return redirect()->route('ShopDatasPage')
                                ->with('message_title', $message_title)
                                ->with('message_type', $message_type)
                                ->with('message', $message);
        }else{
            $message_title = "登入失敗";
            $message_type = "error";
            $message = "帳號或密碼錯誤";
            return redirect()->route('ShopLoginPage')
                                ->with('message_title', $message_title)
                                ->with('message_type', $message_type)
                                ->with('message', $message);
        }

    }
    public function ShopDatasPage(Request $request){
        $datas=[
           'shop' => $request->user()->Shop
        ];
        return view('phone.shop.ShopDatasPage', $datas);
    }
    public function ShopHistoryPage(Request $request){
        $datas = [
            'PayPointRecords' => $request->user()->Shop->PayPointRecord->where('member_id','<>',null)->sortByDesc('id')
        ];
        // return $datas;
        return view('phone.shop.ShopHistoryPage', $datas);
    }
    public function ShopGivePointPage(Request $request){
        $datas=[
           'shop1' => $request->user()->Shop,
            'shop2' => $request->user()->Shop->with('Museum')->get()
         ];
         return $datas;
        return view('phone.shop.ShopGivePointPage', $datas);
    }

    public function ShopGivePoint(Request $request){
        $shop = $request->user()->Shop;
        // 驗證傳入的數據
        $validatedData = $request->validate([
            'point' => 'numeric|integer|min:0|not_in:0',
            'price' => 'numeric|integer|min:0|not_in:0',
        ],[
            'point.numeric' => ':attribute需為數字',
            'price.numeric' => ':attribute需為數字',

            'point.integer' => ':attribute需為整數',
            'price.integer' => ':attribute需為整數',
            
            'point.not_in' => ':attribute不能低於零',
            'price.not_in' => ':attribute不能低於零',

            'point.min' => ':attribute不能低於零',
            'price.min' => ':attribute不能低於零',
        ],[
            'point'=>'消費點',
            'price'=>'消費金額',
        ]);

        // 生成銷消費紀錄單
        $PPR = PayPointRecord::create([
            'shop_id' => $shop->id,
            'shop_name' => $shop->name,
            'price' => $validatedData['price'],
            'point' => $validatedData['point'],
        ]);
        // 生成QRcode
        $QR = $PPR->Qrcode()->create();
        
        $datas = [
            'museum' => $request->user()->Shop->Museum,
            'ppr' => $PPR,
            'qr' => $QR,
        ];
        return view('phone.shop.ShopQrcodePointPage', $datas);
    }
}
