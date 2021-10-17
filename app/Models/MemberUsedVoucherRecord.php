<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberUsedVoucherRecord extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $dates = [
        'start_at',
        'end_at',
        'pvr_updated_at'
    ];
    /**
     * 所屬兌換券
     */
    public function Voucher()
    {
        return $this->belongsTo('App\Models\Voucher');
    }
    /**
     * 所屬民眾
     */
    public function Member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    /**
     * 取得兌換券下的兌換券紀錄狀態
     */
    public function VoucherRecordStatus()
    {
        return $this->hasOne('App\Models\VoucherRecordStatus', 'voucher_record_id')->orderBy('id', 'desc');
    }
    /**
     * 取得兌換券紀錄下的預購資料
     */
    public function PreVoucherRecord()
    {
        return $this->hasOne('App\Models\PreVoucherRecord', 'voucher_record_id')->orderBy('id', 'desc');
    }
}
