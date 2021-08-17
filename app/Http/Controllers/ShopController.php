<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 觸及資料庫
use App\Models\User;
use App\Models\Shop;
use App\Models\Museum;
use App\Models\PayPointRecord;



class ShopController extends Controller
{
    // 商家列表頁
    public function ShopsPage($museum_id, Request $request){
        $museum = Museum::where('id',$museum_id)->first();
        $shops = Shop::latest()->with('CreatedStaff')->where('museum_id',$museum_id);
        if(!($request['status'] && $request['status'] == 'ShowDisable')){
            $shops = $shops->where('status','enable');
        } 
        
        $shops =  $shops->paginate(10);

        if($request['status'] ){
            $shops->appends(['status' => $request['status']]);
        }
       
        $data = [
            'museum'=> $museum,
            'shops'=> $shops
        ];
        
        return view('admin.shops.ShopsPage' , $data);
    }
    // 新增商家頁
    public function CreateShopPage($museum_id){
        $museum = Museum::where('id',$museum_id)->first();
        $data = [
            'museum'=> $museum,
        ];
        return view('admin.shops.CreateShopPage', $data);

    }
    // 新增商家
    public function CreateShop($museum_id, Request $request){
        // 驗證傳入的數據
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'password' => 'required|confirmed' ,
            'description' => 'max:1000',
        ],[
            'name.required' => ':attribute為必填',
            'phone.required' => ':attribute為必填',
            'password.required' => ':attribute為必填',
            'password.confirmed' => ':attribute重複錯誤',
            'description.max' => ':attribute最多只能輸入:max個字',
        ],[
            'name'=>'館舍名稱',
            'phone'=>'館舍電話',
            'password'=>'密碼',
            'description'=>'簡介',
        ]);
        // 確認是否存在在Shop表裡
        if(Shop::where('phone', $validatedData['phone'])->first()){
            $message_title = "新增錯誤";
            $message_type = "error";
            $message = "已註冊過";
            return redirect()->route('ShopsPage',['museum_id'=>$museum_id])
            ->with('message_title', $message_title)
            ->with('message_type', $message_type)
            ->with('message', $message);
        }
        $validatedData['email'] = $validatedData['phone'].'@shop.museum.tw';
        // 確認是否存在在User表裡
        $user = User::where('email', $validatedData['email'])->first();
        if($user == NULL){
            // 新增至User表
            $user = new User([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password'])
            ]);
            $user->save();
        }
        // 新增至Shop表
        $shop = new Shop([
            'museum_id' => $museum_id,
            'user_id' => $user['id'],
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'description' => $validatedData['description']
        ]);
        if($request->user() && $request->user()->Staff){
            $shop['created_staff_id'] = $request->user()->Staff->id;
        }
        // dd($museum['created_staff_id']);
        $shop->save();
        
        $message_title = "新增成功";
        $message_type = "success";
        $message = "完成(".$validatedData['name'].")商家新增";
        return redirect()->route('ShopsPage',['museum_id'=>$museum_id])
                            ->with('message_title', $message_title)
                            ->with('message_type', $message_type)
                            ->with('message', $message);
    }
    // 商家單頁
    public function ShopPage($museum_id, $shop_id){
        $museum = Museum::where('id',$museum_id)->first();
        $shop = Shop::with('CreatedStaff')->where('id',$shop_id)->first();
        $data = [
            'museum' => $museum,
            'shop' => $shop
        ];
        return view('admin.shops.ShopPage', $data);
    }
    // 封存商家
    public function DisableShop($museum_id, $shop_id, Request $request){
        $shop = Shop::where('id',$shop_id)->first();
        // 狀態改為停用
        $shop['status'] = 'disable';
        // 修改更新人的id
        $shop['updated_staff_id'] = $request->user()->Staff->id;
        // 存入資料庫
        $shop->update();
        $message_title = "封存成功";
        $message_type = "success";
        $message = "已將".$shop['name']."的資料從商家中封存";
        return redirect()->route('ShopPage', ['museum_id'=>$museum_id,  'shop_id'=>$shop_id])
            ->with('message_title', $message_title)
            ->with('message_type', $message_type)
            ->with('message', $message);
    }
    // 刪除商家
    public function DeleteShop($museum_id, $shop_id){
        $shop = Shop::where('id',$shop_id)->first();
        $shop->delete();
        $message_title = "刪除成功";
        $message_type = "success";
        $message = "已將".$shop['name']."的資料從商家中刪除";
        return redirect()->route('ShopsPage', ['museum_id'=>$museum_id])
            ->with('message_title', $message_title)
            ->with('message_type', $message_type)
            ->with('message', $message);
    }
    // 編輯商家頁
    public function EditShopPage($museum_id, $shop_id){
        $museum = Museum::where('id',$museum_id)->first();
        $shop = Shop::with('CreatedStaff')->where('id',$shop_id)->first();
        $data = [
            'museum' => $museum,
            'shop' => $shop
        ];
        return view('admin.shops.EditShopPage', $data);
    }
    // 編輯商家
    public function EditShop($museum_id, $shop_id, Request $request){
        $update_times=0;
        $update_password=0;
        $shop = Shop::with('CreatedStaff')->where('id',$shop_id)->first();
        // $museum = Museum::with('CreatedStaff')->where('id',$museum_id)->first();
        // 確認傳入資料都符合格式
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'max:1000',
        ],[
            'name.required' => ':attribute為必填',
            'description.max' => ':attribute最多只能輸入:max個字',
        ],[
            'name'=>'館舍名稱',
            'description'=>'簡介',
        ]);
        // 確認是否更新密碼
        if($request['password']!=''){
            // 確認密碼是否一致
            if($request['password']!=$request['password_confirmation']){
                $message_title = "更新失敗";
                $message_type = "error";
                $message = "重複密碼錯誤";
                return redirect()->route('EditShopPage', ['museum_id'=>$museum_id,  'shop_id'=>$shop_id])
                    ->with('message_title', $message_title)
                    ->with('message_type', $message_type)
                    ->with('message', $message);
            }else{
                $update_password++;
                $user = User::where('id', $shop->user_id)->first();
                $user['password'] = bcrypt($request['password']);
                $user->update();
            }
        }
        // 確認輸入的名字與資料庫的名字是否一致
        if($request['name'] != $shop['name']){
            $shop['name'] = $request['name'];
            $update_times++;
        }
        // 確認輸入的簡介與資料庫的簡介是否一致
        if($request['description'] != $shop['description']){
            $shop['description'] = $request['description'];
            $update_times++;
        }
        // 存檔
        if($update_times+$update_password!=0){
            // 修改更新人的id
            $shop['updated_staff_id'] = $request->user()->Staff->id;
            // 存入資料庫
            $shop->update();
            $message_title = "更新成功";
            $message_type = "success";
            $message = "已將館舍資料更新並儲存";
            return redirect()->route('ShopPage', ['museum_id'=>$museum_id,  'shop_id'=>$shop_id])
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        }else{
            $message_title = "尚未更新";
            $message_type = "warning";
            $message = "並無修改館舍資料";
            return redirect()->route('EditShopPage', ['museum_id'=>$museum_id,  'shop_id'=>$shop_id])
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        }
    }
    // 消費紀錄列表頁
    public function ShopsHistoryPage($museum_id, $shop_id){
        $museum = Museum::where('id',$museum_id)->first();
        $shop = Shop::where('id',$shop_id)->first();
        $PPRs = PayPointRecord::where('member_id','<>','')->latest()->where('shop_id',$shop_id)->paginate(10);
        $data = [
            'shop'=> $shop,
            'PPRs'=> $PPRs,
            'museum'=> $museum
        ];
        return view('admin.shops.ShopsHistoryPage', $data);
    }

}
