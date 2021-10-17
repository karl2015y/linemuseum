<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 觸及資料庫
use App\Models\Voucher;
use App\Models\VoucherWay;

class VoucherController extends Controller
{
    // b0001 兌換券列表頁
    public function VouchersPage(Request $request){
        $vouchers = Voucher::latest()->with('CreatedStaff');
        if(!($request['status'] && $request['status'] == 'ShowDisable')){
            $vouchers = $vouchers->where('status','enable');
        } 
        
        $vouchers =  $vouchers->paginate(10);

        if($request['status'] ){
            $vouchers->appends(['status' => $request['status']]);
        }
       
        $data = [
            'vouchers'=> $vouchers
        ];
        
        return view('admin.vouchers.VouchersPage' , $data);
    }
    // b0002 新增兌換券頁
    public function CreateVoucherPage(){
        return view('admin.vouchers.CreateVoucherPage');

    }
    // b0003 新增兌換券
    public function CreateVoucher(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'start_at' => 'required',
            'end_at' => 'required|after:start_at',
            'amount' => 'required',
            'type' => 'required',
            'description' => 'required',
        ],[
            'name.required' => ':attribute為必填',
            'start_at.required' => ':attribute為必填',
            'end_at.required' => ':attribute為必填',
            'end_at.after' => ':attribute 需要大於 :date',
            'amount.required' => ':attribute為必填',
            'type.required' => ':attribute為必填',
            'description.required' => ':attribute為必填',
  
        ],[
            'name'=>'館舍名稱',
            'start_at' => '開始時間',
            'end_at' => '結束時間',
            'amount'=>'兌換券數量',
            'type'=>'兌換券類型',
            'description'=>'兌換券內容',
        ]);
        // 新增至voucher表
        $voucher = new Voucher([
            'name' => $validatedData['name'],
            'start_at' =>  $validatedData['start_at'],
            'end_at' =>  $validatedData['end_at'],
            'amount' => $validatedData['amount'],
            'type' =>  $validatedData['type'],
            'description' =>  $validatedData['description'],
        ]);
        if($request->user() && $request->user()->Staff){
            $voucher['created_staff_id'] = $request->user()->Staff->id;
        }
        $voucher->save();
   
        return redirect()->route('CreateVoucherPicsPage',['voucher_id'=>$voucher->id]);
            
    }
    // b0003.5 新增兌換券圖片頁
    public function CreateVoucherPicsPage($voucher_id,Request $request){
        $model='create';
        if($request['mode'] && $request['mode'] == 'edit'){
            $model='edit';
        } 
        $voucher = Voucher::where('id',$voucher_id)->first();
        $datas = [
            'model' => $model,
            'voucher' => $voucher
        ];
        return view('admin.vouchers.CreateVoucherPicsPage', $datas);

    }
    // b0004 新增兌換券的購買方式頁
    public function CreateBuyVoucherWayPage($voucher_id){
        $voucher = Voucher::with('CreatedStaff')->where('id',$voucher_id)->first();

        $datas = [
            'voucher' => $voucher
        ];
        return view('admin.vouchers.CreateBuyVoucherWayPage', $datas);
        
    }
    // b0005 刪除兌換券的購買方式
    public function DeleteBuyVoucherWay($voucher_id, $voucher_way_id, Request $request){
        $vw = VoucherWay::where('id',$voucher_way_id)->first();
        $vw->delete();

        $voucher = Voucher::where('id',$voucher_id)->first();
        $voucher['updated_staff_id'] = null;
        $voucher->save();
        $voucher['updated_staff_id'] = $request->user()->Staff->id;
        $voucher->save();

        $message_title = "刪除成功";
        $message_type = "success";
        $message = "已將該方法從購買方式中刪除";
        return redirect()->route('VucherPage', ['voucher_id'=>$voucher_id ])
            ->with('message_title', $message_title)
            ->with('message_type', $message_type)
            ->with('message', $message);
    }
    // b0006 兌換券單頁
    public function VucherPage($voucher_id){
        $voucher = Voucher::with('CreatedStaff')->with('VoucherWay')->where('id',$voucher_id)->first();
        $change_pic_url_times = 0;
        if($voucher->Pic_1 == null){
            $voucher->update([
                'Pic_1'=>"/storage/vouchers/{$voucher->id}/pic1.jpg"
            ]);
            $change_pic_url_times++;
        }
        if($voucher->Pic_2 == null){
            $voucher->update([
                'Pic_2'=>"/storage/vouchers/{$voucher->id}/pic2.jpg"
            ]);
            $change_pic_url_times++;
        }
        if($change_pic_url_times>0){
            $voucher = Voucher::with('CreatedStaff')->with('VoucherWay')->where('id',$voucher_id)->first();
        }
        $data = [
            'voucher' => $voucher
        ];
        // return $data;
        return view('admin.vouchers.VucherPage', $data);
    }
    // b0007 新增兌換券的購買方式
    public function CreateBuyVoucherWay(Request $request, $voucher_id){

        $validatedData = $request->validate([
            'pay_point' => 'required',
            'knowledge_point' => 'required',
        ],[
            'pay_point.required' => ':attribute為必填',
            'knowledge_point.required' => ':attribute為必填',
        ],[
            'pay_point'=>'消費點',
            'knowledge_point' => '知識點',
        ]);

        // 新增至voucher表
        $vw = new VoucherWay([
            'pay_point' => $validatedData['pay_point'],
            'knowledge_point' =>  $validatedData['knowledge_point'],
            'voucher_id' =>  $voucher_id,
        ]);

        $vw->save();

        $voucher = Voucher::where('id',$voucher_id)->first();
        $voucher['updated_staff_id'] = $request->user()->Staff->id;
        $voucher->save();

        $message_title = "新增成功";
        $message_type = "success";
        $message = "完成兌換券的新增";
        return redirect()->route('VucherPage', ['voucher_id'=>$voucher_id ])
                            ->with('message_title', $message_title)
                            ->with('message_type', $message_type)
                            ->with('message', $message);
    }
    // b0008 封存兌換券
    public function DisableVucher(Request $request,$voucher_id){
        $voucher = Voucher::where('id',$voucher_id)->first();
        // 狀態改為停用
        $voucher['status'] = 'disable';
        // 修改更新人的id
        $voucher['updated_staff_id'] = $request->user()->Staff->id;
        // 存入資料庫
        $voucher->update();
        $message_title = "封存成功";
        $message_type = "success";
        $message = "已將".$voucher['name']."的資料從兌換券中封存";
        return redirect()->back()
            ->with('message_title', $message_title)
            ->with('message_type', $message_type)
            ->with('message', $message);
    
    }
    // b0009 刪除兌換券
    public function DeleteVucher( $voucher_id){
        VoucherWay::where('voucher_id', $voucher_id)->delete(); 
        $voucher = Voucher::with('VoucherWay')->where('id',$voucher_id)->first();

        if(count($voucher['VoucherWay'])>0){
            $message_title = "刪除失敗";
            $message_type = "error";
            $message = "該兌換券還有兌換方式尚未刪除";
            return redirect()->back()
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        }else{
            $voucher->delete();
            $message_title = "刪除成功";
            $message_type = "success";
            $message = "已將".$voucher['name']."的資料從兌換券中刪除";
            return redirect()->route('VouchersPage')
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        }
    }

}
