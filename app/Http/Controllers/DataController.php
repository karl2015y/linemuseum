<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 時間
use Carbon\Carbon;
// 觸及資料庫
use App\Models\Member;
use App\Models\PayPointRecord;
use App\Models\KnowledgePointRecord;
use App\Models\MemberUsedVoucherRecord;
use App\Models\PreVoucherRecord;

// Excel
use App\Exports\MembersExport;
use App\Exports\PayPointRecordsExport;
use App\Exports\KnowledgePointRecordsExport;
use App\Exports\MemberUsedVoucherRecordsExport;
use App\Exports\AllPrebuyVouchersExport;
use App\Exports\PrebuyVouchersExport;



use Maatwebsite\Excel\Facades\Excel;

class DataController extends Controller
{
    // d0001 民眾基本列表頁
    public function MembersPage()
    {
        $members = Member::latest();
        $members =  $members->paginate(10);
        $data = [
            'members' => $members
        ];
        return view('admin.datas.MembersPage', $data);
    }
    // d0002 匯出民眾基本列表
    public function MembersExport()
    {
        $today =  Carbon::now()->toDateTimeString();
        return Excel::download(new MembersExport, "{$today}_民眾基本資料.xlsx");
    }
    // d0003 兌換券記錄列表頁
    public function VouchersHistoryPage()
    {
        $VCRs = MemberUsedVoucherRecord::latest()
            ->with('VoucherRecordStatus')
            ->join('vouchers', 'member_used_voucher_records.voucher_id', '=', 'vouchers.id')
            ->select('member_used_voucher_records.*', 'vouchers.type as type')
            ->where('type', '=', 'normal')
            ->paginate(10);
        $data = [
            'VCRs' => $VCRs,
        ];
        // return $data;
        return view('admin.datas.VouchersHistoryPage', $data);
    }
    // d0004 匯出兌換券記錄列表
    public function VouchersHistoryExport()
    {
        $today =  Carbon::now()->toDateTimeString();
        return Excel::download(new MemberUsedVoucherRecordsExport, "{$today}_兌換券記錄資料.xlsx");
    }
    // d0005 消耗點數發放列表頁
    public function PayPointHistoryPage()
    {
        $PPRs = PayPointRecord::where('member_id', '<>', '')->latest()->with('Shop.Museum')->paginate(10);
        $data = [
            'PPRs' => $PPRs,
        ];
        return view('admin.datas.PayPointHistoryPage', $data);
    }
    // d0006 匯出消耗點數發放列表
    public function PayPointHistoryExport()
    {
        $today =  Carbon::now()->toDateTimeString();
        return Excel::download(new PayPointRecordsExport, "{$today}_消耗點數發放資料.xlsx");
    }
    // d0007 知識點數發放列表頁
    public function KnowledgePointHistoryPage()
    {
        $KPRs = KnowledgePointRecord::latest()->with('KnowledgeActivity.Museum')->paginate(10);
        $data = [
            'KPRs' => $KPRs,
        ];
        return view('admin.datas.KnowledgePointHistoryPage', $data);
    }
    // d0008 匯出知識點數發放列表
    public function KnowledgePointHistoryExport()
    {
        $today =  Carbon::now()->toDateTimeString();
        return Excel::download(new KnowledgePointRecordsExport, "{$today}_知識點數發放資料.xlsx");
    }
    // d0009 預購卷列表頁
    public function PrebuyVouchersHistoryPage(Request $request)
    {
        $VCRs = MemberUsedVoucherRecord::latest()
            ->join('vouchers', 'member_used_voucher_records.voucher_id', '=', 'vouchers.id')
            ->join('pre_voucher_records', 'member_used_voucher_records.id', '=', 'pre_voucher_records.voucher_record_id')
            ->select(
                'member_used_voucher_records.*',
                'vouchers.type as type',
                'pre_voucher_records.id as pvr_id',
                'pre_voucher_records.name as pvr_name',
                'pre_voucher_records.email as pvr_email',
                'pre_voucher_records.address as pvr_address',
                'pre_voucher_records.phone as pvr_phone',
                'pre_voucher_records.current_status as pvr_current_status',
                'pre_voucher_records.updated_at as pvr_updated_at'
            )
            ->where('type', '=', 'pre');
        // ->paginate(10);



        if ($request['status'] && $request['status'] == 'ShowOut') {
            $VCRs = $VCRs;
        } else {
            $VCRs = $VCRs->where('current_status', '準備中');
        }

        $VCRs =  $VCRs->paginate(10);

        if ($request['status']) {
            $VCRs->appends(['status' => $request['status']]);
        }



        $data = [
            'VCRs' => $VCRs,
        ];
        // return $data;
        return view('admin.datas.PrebuyVouchersHistoryPage', $data);
    }
    // d0010 已寄出預購卷頁
    public function PrebuyVoucherPage($pvr_id)
    {
        $PVR = PreVoucherRecord::where("id", $pvr_id)->with('VoucherRecord')->first();
        $data = [
            'PVR' => $PVR,
        ];
        // return $data;
        return view('admin.datas.PrebuyVoucherPage', $data);
    }
    // d0011 已寄出預購卷頁
    public function PrebuyVoucher($pvr_id, Request $request)
    {
        // 驗證傳入的數據
        $validatedData = $request->validate([
            'member_note' => 'required',
        ], [
            'member_note.required' => ':attribute為必填',
        ], [
            'member_note' => '寄件備註',
        ]);
        $PVR = PreVoucherRecord::where("id", $pvr_id);
        $PVR_data = PreVoucherRecord::where("id", $pvr_id)->first();
        $PVR->update([
            'member_note' => $validatedData['member_note'],
            'current_status' => "已寄出",
            'status_list' => '<li>' . Carbon::now() . ' -> 已寄出</li>' . $PVR_data['status_list'],
        ]);


        //寄 email
        $details = [
            'title' => '藝點通預購通知',
            'member_note' =>$validatedData['member_note'],
        ];
        \Illuminate\Support\Facades\Mail::to($PVR_data['email'])->send(new \App\Mail\PrebuyMail($details));
        
        // if($PVR_data['email']==$request->user()->email){
        //     \Illuminate\Support\Facades\Mail::to($PVR_data['email'])->send(new \App\Mail\PrebuyMail($details));
        // }else{
        //     \Illuminate\Support\Facades\Mail::to($PVR_data['email'])->send(new \App\Mail\PrebuyMail($details));
        //     \Illuminate\Support\Facades\Mail::to($PVR_data->User->email)->send(new \App\Mail\PrebuyMail($details));

        // }


        $message_title = "寄出成功";
        $message_type = "success";
        $message = "已用email通知會員與收件人";
        return redirect()->back()
            ->with('message_title', $message_title)
            ->with('message_type', $message_type)
            ->with('message', $message);
    }

    // d0012 匯出全部預購卷
    public function PrebuyVouchersAllExport()
    {
        $today =  Carbon::now()->toDateTimeString();
        return Excel::download(new AllPrebuyVouchersExport, "{$today}_全部預購卷資料.xlsx");
    }

    // d0012 匯出準備中預購卷
    public function PrebuyVouchersExport()
    {
        $today =  Carbon::now()->toDateTimeString();
        return Excel::download(new PrebuyVouchersExport, "{$today}_準備中預購卷資料.xlsx");
    }
}
