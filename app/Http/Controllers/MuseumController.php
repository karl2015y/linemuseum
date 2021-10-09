<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 觸及資料庫
use App\Models\User;
use App\Models\Museum;

class MuseumController extends Controller
{
    //館舍列表頁
    public function MuseumsPage(Request $request){
        if($request['status'] && $request['status'] == 'ShowDisable'){
            $museums = Museum::latest()->with('CreatedStaff');
        }else{
            $museums = Museum::latest()->where('status','enable')->with('CreatedStaff');
        } 
        
        $museums =  $museums->paginate(10);

        if($request['status'] ){
            $museums->appends(['status' => $request['status']]);
        }
       
        $data = [
            'museums'=> $museums
        ];
        
        return view('admin.museums.MuseumsPage' , $data);
    }
    // 新增館舍頁
    public function CreateMuseumPage(){
        return view('admin.museums.CreateMuseumPage');
    }
    // [Post] 新增館舍
    public function CreateMuseum(Request $request){
        // 驗證傳入的數據
        $validatedData = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'buy_hundred_get_point' => 'required|integer ',
            'email' => 'required|email',
            'password' => 'required|confirmed' ,
            'description' => 'max:1000',
        ],[
            'name.required' => ':attribute為必填',
            'address.required' => ':attribute為必填',
            'phone.required' => ':attribute為必填',
            'buy_hundred_get_point.required' => ':attribute為必填',
            'buy_hundred_get_point.integer' => ':attribute必須為整數',
            'email.required' => ':attribute為必填',
            'password.required' => ':attribute為必填',
            'password.confirmed' => ':attribute重複錯誤',
            'description.max' => ':attribute最多只能輸入:max個字',
        ],[
            'name'=>'館舍名稱',
            'address'=>'館舍地址',
            'phone'=>'館舍電話',
            'buy_hundred_get_point'=>'消費點(點/元)',
            'email'=>'館舍人員信箱',
            'password'=>'密碼',
            'description'=>'簡介',
        ]);
        // 確認是否存在在Museum表裡
        if(Museum::where('email', $validatedData['email'])->first()){
            $message_title = "新增錯誤";
            $message_type = "error";
            $message = "已註冊過";
            return redirect()->route('MuseumsPage')
                                ->with('message_title', $message_title)
                                ->with('message_type', $message_type)
                                ->with('message', $message);
        }
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
        // 新增至Museum表
        $museum = new Museum([
            'user_id' => $user['id'],
            'name' => $validatedData['name'],
            'address' => $validatedData['address'],
            'phone' => $validatedData['phone'],
            'buy_hundred_get_point' => $validatedData['buy_hundred_get_point'],
            'email' => $validatedData['email'],
            'description' => $validatedData['description']
        ]);
        if($request->user() && $request->user()->Staff){
            $museum['created_staff_id'] = $request->user()->Staff->id;
        }
        // dd($museum['created_staff_id']);
        $museum->save();
        
        $message_title = "新增成功";
        $message_type = "success";
        $message = "完成(".$validatedData['name'].")館舍新增";
        return redirect()->route('MuseumsPage')
                            ->with('message_title', $message_title)
                            ->with('message_type', $message_type)
                            ->with('message', $message);
    }
    // 館舍單頁
    public function MuseumPage($museum_id){
        $museum = Museum::with('CreatedStaff')->where('id',$museum_id)->first();
        $data = [
            'museum' => $museum
        ];
        return view('admin.museums.MuseumPage', $data);
    }
    // [Put] 封存館舍
    public function DisableMuseum($museum_id, Request $request){
        $museum = Museum::with('CreatedStaff')->where('id',$museum_id)->first();
        // 狀態改為停用
        $museum['status'] = 'disable';
        // 修改更新人的id
        $museum['updated_staff_id'] = $request->user()->Staff->id;
        // 存入資料庫
        $museum->update();
        $message_title = "封存成功";
        $message_type = "success";
        $message = "已將".$museum['name']."的資料從館舍中封存";
        return redirect()->route('MuseumPage', ['museum_id'=>$museum->id ])
            ->with('message_title', $message_title)
            ->with('message_type', $message_type)
            ->with('message', $message);
    }
    // [Delete] 刪除館舍
    public function DeleteMuseum(){
        // 確認該館舍下是否有剩餘商家
        // 確認該館舍下是否有剩餘知識點活動
        // 都沒有才可以刪除
    }
    // 編輯館舍頁
    public function EditMuseumPage($museum_id){
        $museum = Museum::where('id',$museum_id)->first();
        $data = [
            'museum' => $museum
        ];
        return view('admin.museums.EditMuseumPage', $data);
    }
    // [Put] 編輯館舍
    public function EditMuseum($museum_id, Request $request){
        $update_times=0;
        $update_password=0;
        $museum = Museum::with('CreatedStaff')->where('id',$museum_id)->first();
        // 確認傳入資料都符合格式
        $validatedData = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'buy_hundred_get_point' => 'required|integer ',
            'description' => 'max:1000',
        ],[
            'name.required' => ':attribute為必填',
            'address.required' => ':attribute為必填',
            'phone.required' => ':attribute為必填',
            'buy_hundred_get_point.required' => ':attribute為必填',
            'buy_hundred_get_point.integer' => ':attribute必須為整數',
            'description.max' => ':attribute最多只能輸入:max個字',
        ],[
            'name'=>'館舍名稱',
            'address'=>'館舍地址',
            'phone'=>'館舍電話',
            'buy_hundred_get_point'=>'消費點(點/元)',
            'description'=>'簡介',
        ]);
        // 確認是否更新密碼
        if($request['password']!=''){
            // 確認密碼是否一致
            if($request['password']!=$request['password_confirmation']){
                $message_title = "更新失敗";
                $message_type = "error";
                $message = "重複密碼錯誤";
                return redirect()->route('EditMuseumPage', ['museum_id'=>$museum->id ])
                    ->with('message_title', $message_title)
                    ->with('message_type', $message_type)
                    ->with('message', $message);
            }else{
                $update_password++;
                $user = User::where('id', $museum->user_id)->first();
                $user['password'] = bcrypt($request['password']);
                $user->update();
            }
        }
        // 確認輸入的名字與資料庫的名字是否一致
        if($request['name'] != $museum['name']){
            $museum['name'] = $request['name'];
            $update_times++;
        }
        // 確認輸入的館舍地址與資料庫的館舍地址是否一致
        if($request['address'] != $museum['address']){
            $museum['address'] = $request['address'];
            $update_times++;
        }
        // 確認輸入的館舍電話與資料庫的館舍電話是否一致
        if($request['phone'] != $museum['phone']){
            $museum['phone'] = $request['phone'];
            $update_times++;
        }
        // 確認輸入的消費百點送與資料庫的消費百點送是否一致
        if($request['buy_hundred_get_point'] != $museum['buy_hundred_get_point']){
            $museum['buy_hundred_get_point'] = $request['buy_hundred_get_point'];
            $update_times++;
        }
        // 確認輸入的簡介與資料庫的簡介是否一致
        if($request['description'] != $museum['description']){
            $museum['description'] = $request['description'];
            $update_times++;
        }
        // 存檔
        if($update_times+$update_password!=0){
            // 修改更新人的id
            $museum['updated_staff_id'] = $request->user()->Staff->id;
            // 存入資料庫
            $museum->update();
            $message_title = "更新成功";
            $message_type = "success";
            $message = "已將館舍資料更新並儲存";
            return redirect()->route('MuseumPage', ['museum_id'=>$museum->id ])
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        }else{
            $message_title = "尚未更新";
            $message_type = "warning";
            $message = "並無修改館舍資料";
            return redirect()->route('EditMuseumPage', ['museum_id'=>$museum->id ])
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        }
    }
}
