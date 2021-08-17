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

// Excel
use App\Exports\MembersExport;
use App\Exports\PayPointRecordsExport;
use App\Exports\KnowledgePointRecordsExport;
use App\Exports\MemberUsedVoucherRecordsExport;



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
        $VCRs = MemberUsedVoucherRecord::latest()->with('VoucherRecordStatus')->paginate(10);
        $data = [
            'VCRs' => $VCRs,
        ];
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
        $PPRs = PayPointRecord::where('member_id','<>','')->latest()->with('Shop.Museum')->paginate(10);
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
}
