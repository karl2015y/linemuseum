<?php

namespace App\Exports;

use App\Models\MemberUsedVoucherRecord;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PrebuyVouchersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return MemberUsedVoucherRecord::latest()
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
        ->where('type', '=', 'pre')->where('current_status', '準備中')->get();
    }
    public function headings(): array
    {
        return ["訂單編號", "預購卷名稱", "購買時間", "訂單狀態", "收件人名稱", "收件人信箱", "收件人地址", "收件人電話", "訂單狀態更新時間"];
    }
    public function map($VCR): array
    {
        return [
            $VCR->id,
            $VCR->voucher_name,
            $VCR->created_at->toDateTimeString(),
            $VCR->pvr_current_status,
            $VCR->pvr_name,
            $VCR->pvr_email,
            $VCR->pvr_address,
            $VCR->pvr_phone,
            $VCR->pvr_updated_at->toDateTimeString()

        ];
    }
}
