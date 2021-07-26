<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


// 觸及資料庫
use App\Models\User;
use App\Models\Staff;

// 使用到其他的服務
use Illuminate\Support\Facades\Auth;


class StaffController extends Controller
{
    //總管人員頁 a0001
    public function StaffsPage(Request $request){
       
        if($request['status'] && $request['status'] == 'ShowDisable'){
            $staffs = Staff::latest()->with('CreatedStaff');
        }else{
            $staffs = Staff::latest()->where('status','enable')->with('CreatedStaff');
        } 
        
        $staffs =  $staffs->paginate(10);

        if($request['status'] ){
            $staffs->appends(['status' => $request['status']]);
        }
       
        $data = [
            'staffs'=> $staffs
        ];
        
        return view('admin.staffs.Staffspage' , $data);
    }
    //新增總管人員頁 a0002
    public function CreateStaffPage(){
        return view('admin.staffs.CreateStaffPage');
    }
    //[Post]新增總管人員 a0003
    public function CreateStaff(Request $request){
        // 驗證傳入的數據
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'description' => 'max:1000',
            'password' => 'required|confirmed' ,
        ],[
            'name.required' => ':attribute為必填',
            'email.required' => ':attribute為必填',
            'description.max' => ':attribute最多只能輸入:max個字',
            'password.required' => ':attribute為必填',
            'password.confirmed' => ':attribute重複錯誤',
        ],[
            'name'=>'人員名稱',
            'email'=>'人員信箱',
            'description'=>'簡介',
            'password'=>'密碼',
        ]);
        
        // 確認是否存在在Staff表裡
        if(Staff::where('email', $validatedData['email'])->first()){
            $message_title = "新增錯誤";
            $message_type = "error";
            $message = "已註冊過";
            return redirect()->route('StaffsPage')
                             ->with('message_title', $message_title)
                             ->with('message_type', $message_type)
                             ->with('message', $message);
        }
        // 確認是否存在在User表裡
        $user = User::where('email', $validatedData['email'])->first();
        if(User::where('email', $validatedData['email'])->first() == NULL){
            // 新增至User表
            $user = new User([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password'])
            ]);
            $user->save();
        }
        // 新增至Staff表
        $staff = new Staff([
            'user_id' => $user['id'],
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'description' => $validatedData['description']
        ]);
        if($request->user() && $request->user()->Staff){
            $staff['created_staff_id'] = $request->user()->Staff->id;
        }
        $staff->save();
        
        $message_title = "新增成功";
        $message_type = "success";
        $message = "完成館舍人員(".$validatedData['name'].")新增";
        return redirect()->route('StaffsPage')
                         ->with('message_title', $message_title)
                         ->with('message_type', $message_type)
                         ->with('message', $message);

    }
    //總管人員單頁 a0004
    public function StaffPage($staff_id){
        $staff = Staff::with('CreatedStaff')->where('id',$staff_id)->first();
        $data = [
            'staff' => $staff
        ];
        return view('admin.staffs.StaffPage', $data);
    }
    //[Put]停用總管人員 a0005
    public function DisableStaff($staff_id, Request $request){
        $staff = Staff::with('CreatedStaff')->where('id',$staff_id)->first();
        // 狀態改為停用
        $staff['status'] = 'disable';
        // 修改更新人的id
        $staff['updated_staff_id'] = $request->user()->Staff->id;
        // 存入資料庫
        $staff->update();
        $message_title = "停用成功";
        $message_type = "success";
        $message = "已將".$staff['name']."的資料從館舍人員中封存";
        return redirect()->route('StaffPage', ['staff_id'=>$staff->id ])
            ->with('message_title', $message_title)
            ->with('message_type', $message_type)
            ->with('message', $message);
    }
    //編輯總管人員頁 a0006
    public function EditStaffPage($staff_id){
        $staff = Staff::where('id',$staff_id)->first();
        $data = [
            'staff' => $staff
        ];
        return view('admin.staffs.EditStaffPage', $data);
    }
    //[Put]修改總管人員資料 a0007
    public function EditStaff($staff_id, Request $request){
        $update_times=0;
        $update_password=0;
        $staff = Staff::with('CreatedStaff')->where('id',$staff_id)->first();
        // 確認輸入的名字是否不為空
        if($request['name']==''){
            $message_title = "更新失敗";
            $message_type = "error";
            $message = "名字不能空白";
            return redirect()->route('EditStaffPage', ['staff_id'=>$staff->id ])
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        }
        // 確認是否更新密碼
        if($request['password']!=''){
            // 確認密碼是否一致
            if($request['password']!=$request['password_confirmation']){
                $message_title = "更新失敗";
                $message_type = "error";
                $message = "重複密碼錯誤";
                return redirect()->route('EditStaffPage', ['staff_id'=>$staff->id ])
                    ->with('message_title', $message_title)
                    ->with('message_type', $message_type)
                    ->with('message', $message);
            }else{
                $update_password++;
                $user = User::where('id', $staff->user_id)->first();
                $user['password'] = bcrypt($request['password']);
                $user->update();
            }
        }
        // 確認輸入的名字與資料庫的名字是否一致
        if($request['name'] != $staff['name']){
            $staff['name'] = $request['name'];
            $update_times++;
        }
        // 確認輸入的簡介與資料庫的簡介是否一致
        if($request['description'] != $staff['description']){
            $staff['description'] = $request['description'];
            $update_times++;
        }
        // 存檔
        if($update_times+$update_password!=0){
            // 修改更新人的id
            $staff['updated_staff_id'] = $request->user()->Staff->id;
            // 存入資料庫
            $staff->update();
            $message_title = "更新成功";
            $message_type = "success";
            $message = "已將館舍人員資料更新並儲存";
            return redirect()->route('StaffPage', ['staff_id'=>$staff->id ])
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        }else{
            $message_title = "尚未更新";
            $message_type = "warning";
            $message = "並無修改館舍人員資料";
            return redirect()->route('EditStaffPage', ['staff_id'=>$staff->id ])
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        }
    

    }
}
