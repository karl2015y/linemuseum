<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Voucher extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $guarded = [];
    protected $dates = [
        'start_at',
        'end_at',
    ];
    /**
     * 新增人
     */
    public function CreatedStaff()
    {
        return $this->belongsTo('App\Models\Staff', 'created_staff_id');
    }
    /**
     * 更改人
     */
    public function UpdatedStaff()
    {
        return $this->belongsTo('App\Models\Staff', 'updated_staff_id');
    }
    /**
     * 取得兌換券的兌換方式
     */
    public function VoucherWay()
    {
        return $this->hasMany('App\Models\VoucherWay');
    }
    /**
     * 取得兌換券下的兌換紀錄
     */
    public function VoucherRecord()
    {
        return $this->hasMany('App\Models\MemberUsedVoucherRecord');
    }
    /**
     * 取得預購券下的資料
     */
    public function PrebuyVoucherRecord()
    {
        return $this->hasMany('App\Models\PreVoucherRecord');
    }
}
