<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 觸及資料庫
use App\Models\KnowledgeActivity;
use App\Models\Museum;

use Carbon\Carbon;


class KnowledgeActivityController extends Controller
{
    // e2001 知識點活動列表頁
    public function KnowledgeActivitiesPage($museum_id, Request $request){
        $museum = Museum::where('id',$museum_id)->first();
        $kas = KnowledgeActivity::latest()->with('CreatedStaff')->where('museum_id',$museum_id);
        if(!($request['status'] && $request['status'] == 'ShowDisable')){
            $kas = $kas->where('status','enable');
        } 
        
        $kas =  $kas->paginate(10);

        if($request['status'] ){
            $kas->appends(['status' => $request['status']]);
        }
       
        $data = [
            'museum'=> $museum,
            'kas'=> $kas
        ];
        
        return view('admin.kas.KnowledgeActivitiesPage' , $data);
    }
    // e2002 新增知識點活動頁
    public function CreateKnowledgeActivityPage($museum_id){
        $museum = Museum::where('id',$museum_id)->first();
        $data = [
            'museum'=> $museum,
        ];
        return view('admin.kas.CreateKnowledgeActivityPage', $data);
    }
    // e2003 新增知識點活動
    public function CreateKnowledgeActivity($museum_id, Request $request){
        // 驗證傳入的數據
        $validatedData = $request->validate([
            'name' => 'required',
            'start_at' => 'required',
            'end_at' => 'required|after:start_at',
            'point' => 'required',
            'point_cycle_hour' => 'required',
            'point_cycle_min' => 'required',
            'description' => 'max:1000',
        ],[
            'name.required' => ':attribute為必填',
            'start_at.required' => ':attribute為必填',
            'end_at.required' => ':attribute為必填',
            'end_at.after' => ':attribute 需要大於 :date',
            'point.required' => ':attribute為必填',
            'point_cycle_hour.required' => ':attribute為必填',
            'point_cycle_min.required' => ':attribute為必填',

            'description.max' => ':attribute最多只能輸入:max個字',
        ],[
            'name'=>'知識點活動名稱',
            'start_at' => '開始時間',
            'end_at' => '結束時間',
            'point' => '給予知識點',
            'point_cycle_hour' => '獲得週期(小時)',
            'point_cycle_min' => '獲得週期(分鐘)',
            'description'=>'簡介',
        ]);
        // 新增至KnowledgeActivity表
        $ka = new KnowledgeActivity([
            'museum_id' => $museum_id,
            'name' => $validatedData['name'],
            'start_at' =>  $validatedData['start_at'],
            'end_at' =>  $validatedData['end_at'],
            'point' => $validatedData['point'],
            'point_cycle_hour' => $validatedData['point_cycle_hour'],
            'point_cycle_min' => $validatedData['point_cycle_min'],
            'description' =>  $validatedData['description'],
        ]);
        if($request->user() && $request->user()->Staff){
            $ka['created_staff_id'] = $request->user()->Staff->id;
        }
        $ka->save();
        $message_title = "新增成功";
        $message_type = "success";
        $message = "完成知識活動(".$validatedData['name'].")的新增";
        return redirect()->route('KnowledgeActivitiesPage',['museum_id'=>$museum_id])
                            ->with('message_title', $message_title)
                            ->with('message_type', $message_type)
                            ->with('message', $message);
    }
    // e2004 知識點活動單頁
    public function KnowledgeActivityPage($museum_id, $ka_id){
        $museum = Museum::where('id',$museum_id)->first();
        $ka = KnowledgeActivity::with('CreatedStaff')->where('id',$ka_id)->first();
        $data = [
            'museum' => $museum,
            'ka' => $ka
        ];
        return view('admin.kas.KnowledgeActivityPage', $data);
    }
    // e2005 封存知識點活動
    public function DisableKnowledgeActivity($museum_id, $ka_id, Request $request){
        $ka = KnowledgeActivity::where('id',$ka_id)->first();
        // 狀態改為停用
        $ka['status'] = 'disable';
        // 修改更新人的id
        $ka['updated_staff_id'] = $request->user()->Staff->id;
        // 存入資料庫
        $ka->update();
        $message_title = "封存成功";
        $message_type = "success";
        $message = "已將".$ka['name']."的資料從知識活動中封存";
        return redirect()->route('KnowledgeActivityPage', ['museum_id'=>$museum_id,  'ka_id'=>$ka_id])
            ->with('message_title', $message_title)
            ->with('message_type', $message_type)
            ->with('message', $message);
    }
    // e2006 刪除知識點活動
    public function DeleteKnowledgeActivity($museum_id, $ka_id){
        $ka = KnowledgeActivity::where('id',$ka_id)->first();
        $ka->delete();
        $message_title = "刪除成功";
        $message_type = "success";
        $message = "已將".$ka['name']."的資料從知識活動中刪除";
        return redirect()->route('KnowledgeActivitiesPage', ['museum_id'=>$museum_id])
            ->with('message_title', $message_title)
            ->with('message_type', $message_type)
            ->with('message', $message);
    }
    // e2007 編輯知識點活動頁
    public function EditKnowledgeActivityPage($museum_id, $ka_id){
        $museum = Museum::where('id',$museum_id)->first();
        $ka = KnowledgeActivity::with('CreatedStaff')->where('id',$ka_id)->first();
        $data = [
            'museum' => $museum,
            'ka' => $ka
        ];
        return view('admin.kas.EditKnowledgeActivityPage', $data);
    }
    // e2008 編輯知識點活動
    public function EditKnowledgeActivity($museum_id, $ka_id, Request $request){
        $update_times=0;
        $ka = KnowledgeActivity::where('id',$ka_id)->first();
        // 確認傳入資料都符合格式
        $validatedData = $request->validate([
            'name' => 'required',
            'start_at' => 'required',
            'end_at' => 'required|after:start_at',
            'point' => 'required',
            'point_cycle_hour' => 'required',
            'point_cycle_min' => 'required',
            'description' => 'max:1000',
        ],[
            'name.required' => ':attribute為必填',
            'start_at.required' => ':attribute為必填',
            'end_at.required' => ':attribute為必填',
            'end_at.after' => ':attribute 需要大於 :date',
            'point.required' => ':attribute為必填',
            'point_cycle_hour.required' => ':attribute為必填',
            'point_cycle_min.required' => ':attribute為必填',

            'description.max' => ':attribute最多只能輸入:max個字',
        ],[
            'name'=>'知識點活動名稱',
            'start_at' => '開始時間',
            'end_at' => '結束時間',
            'point' => '給予知識點',
            'point_cycle_hour' => '獲得週期(小時)',
            'point_cycle_min' => '獲得週期(分鐘)',
            'description'=>'簡介',
        ]);
        // 確認輸入的名字與資料庫的名字是否一致
        if($request['name'] != $ka['name']){
            $ka['name'] = $request['name'];
            $update_times++;
        }
        // 確認輸入的 開始時間 與資料庫的 開始時間 是否一致
        if($request['start_at'] != $ka['start_at']){
            $ka['start_at'] = $request['start_at'];
            $update_times++;
        }
        // 確認輸入的 結束時間 與資料庫的 結束時間 是否一致
        if($request['end_at'] != $ka['end_at']){
        $ka['end_at'] = $request['end_at'];
        $update_times++;
        }
        // 確認輸入的 給予知識點 與資料庫的 給予知識點 是否一致
        if($request['point'] != $ka['point']){
            $ka['point'] = $request['point'];
            $update_times++;
        }
        // 確認輸入的 獲得週期(小時) 與資料庫的 獲得週期(小時) 是否一致
        if($request['point_cycle_hour'] != $ka['point_cycle_hour']){
        $ka['point_cycle_hour'] = $request['point_cycle_hour'];
        $update_times++;
        }
        // 確認輸入的 獲得週期(分鐘) 與資料庫的 獲得週期(分鐘) 是否一致
        if($request['point_cycle_min'] != $ka['point_cycle_min']){
            $ka['point_cycle_min'] = $request['point_cycle_min'];
            $update_times++;
        }
        // 確認輸入的簡介與資料庫的簡介是否一致
        if($request['description'] != $ka['description']){
            $ka['description'] = $request['description'];
            $update_times++;
        }
        // 存檔
        if($update_times!=0){
            // 修改更新人的id
            $ka['updated_staff_id'] = $request->user()->Staff->id;
            // 存入資料庫
            $ka->update();
            $message_title = "更新成功";
            $message_type = "success";
            $message = "已將活動資料更新並儲存";
            return redirect()->route('KnowledgeActivityPage', ['museum_id'=>$museum_id,  'ka_id'=>$ka_id])
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        }else{
            $message_title = "尚未更新";
            $message_type = "warning";
            $message = "並無修改活動資料";
            return redirect()->route('EditKnowledgeActivityPage', ['museum_id'=>$museum_id,  'ka_id'=>$ka_id])
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        }
    }
    // e2009 知識點紀錄列表頁
    public function KnowledgeActivityHistoryPage(){}
}


