<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherRecordStatus extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * 所屬兌換券紀錄
    */
    public function VoucherRecord()
    {
        return $this->belongsTo('App\Models\MemberUsedVoucherRecord', 'voucher_record_id');
    }
}
