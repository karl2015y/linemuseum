<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;


class MemberVoucherController extends Controller
{
    // i0011 我的兌換券頁
    public function MemberVouchersPage(Request $request)
    {
        $now = Carbon::now();

        // 已兌換兌換券列數量
        $used_vcrs_count = $request->user()->member->VoucherRecord()
            ->orderBy('id', 'desc')
            ->with('Voucher')
            ->with('VoucherRecordStatus')
            ->get()
            ->where('Voucher.type', '=', 'normal')
            ->where('VoucherRecordStatus.status', '=', 'used')->count();
        


        // 已過期兌換券列數量
        $vcrs = $request->user()->member->VoucherRecord()
            ->where('end_at', '<=', $now)
            ->with('Voucher')
            ->with('VoucherRecordStatus')
            ->get()
            ->where('Voucher.type', '=', 'normal')
            ->where('VoucherRecordStatus.status', '=', 'unused');

        if ($vcrs->count() > 0) {
            foreach ($vcrs as $vcr) {
                if ($vcr->VoucherRecordStatus->status != 'pass') {
                    $vcr->VoucherRecordStatus()->create([
                        'status' => 'pass'
                    ]);
                }
            }
        }
        $pass_vcrs_count = $request->user()->member->VoucherRecord()
            ->orderBy('id', 'desc')
            ->with('VoucherRecordStatus')
            ->get()
            ->where('VoucherRecordStatus.status', '=', 'pass')->count();

        // 未兌換兌換券列表數量
        $unused_vcrs_count = $request->user()->member->VoucherRecord()
            ->orderBy('id', 'desc')
            ->where('end_at', '>', $now)
            ->with('Voucher')
            ->with('VoucherRecordStatus')
            ->get()
            ->where('Voucher.type', '=', 'normal')
            ->where('VoucherRecordStatus.status', '=', 'unused')->count();

        // 預購兌換券列
        $prebuy_vcrs_count = $request->user()->member->VoucherRecord()
            ->orderBy('id', 'desc')
            ->with('Voucher')
            ->with('PreVoucherRecord')
            ->get()
            ->where('PreVoucherRecord', '<>', null)
            ->where('PreVoucherRecord.current_status', '=', '準備中')
            ->where('Voucher.type', '=', 'pre')->count();

        $datas = [
            'used_vcrs_count' => $used_vcrs_count,
            'pass_vcrs_count' => $pass_vcrs_count,
            'unused_vcrs_count' => $unused_vcrs_count,
            'prebuy_vcrs_count' => $prebuy_vcrs_count,
        ];

        // return $datas;

        return view('phone.member.myvoucher.MemberVouchersPage',$datas);
    }
    // i0012 我的已兌換兌換券列表頁
    public function MemberUsedVouchersPage(Request $request)
    {
        $vcrs = $request->user()->member->VoucherRecord()
            ->orderBy('id', 'desc')
            ->with('Voucher')
            ->with('VoucherRecordStatus')
            ->get()
            ->where('Voucher.type', '=', 'normal')
            ->where('VoucherRecordStatus.status', '=', 'used');
        $datas = [
            'vcrs' => $vcrs
        ];
        // return $datas;
        return view('phone.member.myvoucher.MemberUsedVouchersPage', $datas);
    }
    // i0013 我的已過期兌換券列表頁
    public function MemberPassedVouchersPage(Request $request)
    {
        $now = Carbon::now();

        $vcrs = $request->user()->member->VoucherRecord()
            ->where('end_at', '<=', $now)
            ->with('Voucher')
            ->with('VoucherRecordStatus')
            ->get()
            ->where('Voucher.type', '=', 'normal')
            ->where('VoucherRecordStatus.status', '=', 'unused');

        if ($vcrs->count() > 0) {
            foreach ($vcrs as $vcr) {
                if ($vcr->VoucherRecordStatus->status != 'pass') {
                    $vcr->VoucherRecordStatus()->create([
                        'status' => 'pass'
                    ]);
                }
            }
        }

        $vcrs = $request->user()->member->VoucherRecord()
            ->orderBy('id', 'desc')
            ->with('VoucherRecordStatus')
            ->get()
            ->where('VoucherRecordStatus.status', '=', 'pass');

        $datas = [
            'vcrs' => $vcrs
        ];
        // return $datas;
        return view('phone.member.myvoucher.MemberPassedVouchersPage', $datas);
    }
    // i0014 我的未兌換兌換券列表頁
    public function MemberCanUseVouchersPage(Request $request)
    {
        $now = Carbon::now();

        $vcrs = $request->user()->member->VoucherRecord()
            ->orderBy('id', 'desc')
            ->where('end_at', '>', $now)
            ->with('Voucher')
            ->with('VoucherRecordStatus')
            ->get()
            ->where('Voucher.type', '=', 'normal')
            ->where('VoucherRecordStatus.status', '=', 'unused');
        $datas = [
            'vcrs' => $vcrs
        ];
        // return $datas;
        return view('phone.member.myvoucher.MemberCanUseVouchersPage', $datas);
    }
    // 我的預購兌換券列表頁
    public function MemberPrebuyVouchersPage(Request $request)
    {

        $vcrs = $request->user()->member->VoucherRecord()
            ->orderBy('id', 'desc')
            ->with('Voucher')
            ->with('PreVoucherRecord')
            ->get()
            ->where('PreVoucherRecord', '<>', null)
            ->where('Voucher.type', '=', 'pre')
            ->sortByDesc('PreVoucherRecord.current_status');
        $datas = [
            'vcrs' => $vcrs
        ];
        // return $datas;
        return view('phone.member.myvoucher.MemberPrebuyVouchersPage', $datas);
    }
    // i0015 我的兌換券詳細資料頁
    public function MemberVoucherPage(Request $request, $voucher_record_id)
    {
        $now = Carbon::now();
        $vcr = $request->user()->member->VoucherRecord()
            ->where('id', '=', $voucher_record_id)
            ->with('VoucherRecordStatus')
            ->with('PreVoucherRecord')
            ->with('Voucher')
            ->first();
        if ($vcr == null) {
            $message_title = "錯誤";
            $message_type = "error";
            $message = "請重新嘗試";
            return redirect()->back()
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        }
        if($vcr->Voucher->type=='pre'){
            $vcr_status = 'pre';
        }else{
            if ($vcr->VoucherRecordStatus->status == 'used') {
                $vcr_status = 'used';
            } else if ($vcr->end_at > $now && $vcr->VoucherRecordStatus->status == 'unused') {
                $vcr_status = 'unused';
            } else {
                $vcr_status = 'pass';
            }
        }


        $datas = [
            'vcr_status' => $vcr_status,
            'vcr' => $vcr
        ];
        // return $datas;
        return view('phone.member.myvoucher.MemberVoucherPage', $datas);
    }
    // i0016 兌換對換券頁
    public function MemberUseVoucherPage(Request $request, $voucher_record_id)
    {
        $vcr = $request->user()->member->VoucherRecord()
            ->where('id', '=', $voucher_record_id)
            ->with('VoucherRecordStatus')
            ->first();
        if ($vcr == null) {
            $message_title = "錯誤";
            $message_type = "error";
            $message = "請重新嘗試";
            return redirect()->back()
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        }
        $datas = [
            'vcr' => $vcr
        ];
        // return $datas;
        return view('phone.member.myvoucher.MemberUseVoucherPage', $datas);
    }
    // i0017 兌換對換券
    public function MemberUseVoucher(Request $request, $voucher_record_id)
    {
        $now = Carbon::now();
        $vcr = $request->user()->member->VoucherRecord()
            ->where('id', '=', $voucher_record_id)
            ->with('VoucherRecordStatus')
            ->first();
        if ($vcr == null) {
            $message_title = "錯誤";
            $message_type = "error";
            $message = "請重新嘗試";
            return redirect()->back()
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        }

        if ($vcr->VoucherRecordStatus->status == 'used') {
            $vcr_status = 'used';
        } else if ($vcr->end_at > $now && $vcr->VoucherRecordStatus->status == 'unused') {
            $vcr_status = 'unused';
        } else {
            $vcr_status = 'pass';
        }

        if ($vcr_status != 'unused') {
            $message_title = "錯誤";
            $message_type = "error";
            $message = "請重新嘗試";
            return redirect()->back()
                ->with('message_title', $message_title)
                ->with('message_type', $message_type)
                ->with('message', $message);
        }

        $vcr->VoucherRecordStatus()->create([
            'status' => 'used'
        ]);

        $datas = [
            'vcr' => $vcr
        ];

        return view('phone.member.myvoucher.MemberUseVoucherTimePage', $datas);
    }
}
