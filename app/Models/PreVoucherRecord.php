<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreVoucherRecord extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * 所屬兌換券
     */
    public function Voucher()
    {
        return $this->belongsTo('App\Models\Voucher');
    }
    /**
     * 所屬兌換券紀錄
    */
    public function VoucherRecord()
    {
        return $this->belongsTo('App\Models\MemberUsedVoucherRecord', 'voucher_record_id');
    }

    /**
     * 購買人
     */
    public function User()
    {
        return $this->belongsTo('App\Models\Staff', 'user_id');
    }
}
