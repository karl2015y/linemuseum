<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    // 設定頁面
    public function setConfigPage()
    {
        $setting = \App\Models\Setting::where('id', 1)->first();
        if ($setting == null) {
            $setting = \App\Models\Setting::create([
                'singup_get_point' => 10,
            ]);
        }
        $datas = [
            'setting' => $setting
        ];
        return view('admin.setting.setConfigPage', $datas);
    }
    // 處存設定
    public function setConfig(Request $request)
    {
            // 驗證傳入的數據
        $validatedData = $request->validate([
            'singup_get_point' => 'required|numeric|min:0',
        ],[
            'singup_get_point.required' => ':attribute為必填',
            'singup_get_point.numeric' => ':attribute為數字',
            'singup_get_point.min' => ':attribute的值不得低於:min',
        ],[
            'singup_get_point'=>'註冊給知識點',
        ]);

        $setting = \App\Models\Setting::where('id', 1)->first();
        $update_times=0;
        // 確認是否更新註冊給知識點
        if($request['singup_get_point'] != $setting['singup_get_point']){
            $setting['singup_get_point'] = $request['singup_get_point'];
            $update_times++;
        }

        

        if($update_times!=0){
            // 修改更新人的id
            $setting['updated_staff_id'] = $request->user()->Staff->id;

            // 存入資料庫
            $setting->update();

            $message_title = "儲存成功";
            $message_type = "success";
            $message = "已成功更新參數";
            return redirect()->route('setConfigPage')
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        }else{
            $message_title = "尚未更新";
            $message_type = "warning";
            $message = "並無更新參數";
            return redirect()->route('setConfigPage')
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        }
       
    }
}
