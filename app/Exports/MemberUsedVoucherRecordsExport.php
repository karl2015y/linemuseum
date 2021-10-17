<?php

namespace App\Exports;

use App\Models\MemberUsedVoucherRecord;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class MemberUsedVoucherRecordsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return MemberUsedVoucherRecord::with('VoucherRecordStatus')
            ->join('vouchers', 'member_used_voucher_records.voucher_id', '=', 'vouchers.id')
            ->select('member_used_voucher_records.*', 'vouchers.type as type')
            ->where('type', '=', 'normal')
            ->get();
    }

    public function headings(): array
    {
        return ["兌換券編號", "兌換券名稱", "民眾編號", "民眾名稱", "購買時間", "消費點", "知識點", "兌換券狀態", "狀態更新時間"];
    }
    public function map($VCR): array
    {
        return [
            $VCR->voucher_id,
            $VCR->voucher_name,
            $VCR->member_id,
            $VCR->member_name,
            $VCR->created_at->toDateTimeString(),
            $VCR->pay_point,
            $VCR->knowledge_point,
            ['unused' => '未使用', 'used' => '已使用', 'pass' => '已過期'][strval($VCR->VoucherRecordStatus->status)],
            $VCR->VoucherRecordStatus->created_at->toDateTimeString()

        ];
    }
}
