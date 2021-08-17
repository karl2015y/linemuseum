<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * 取得民眾的知識點活動紀錄
     */
    public function KnowledgePointRecord()
    {
        return $this->hasMany('App\Models\KnowledgePointRecord');
    }
    /**
     * 取得民眾的消費點活動紀錄
     */
    public function PayPointRecord()
    {
        return $this->hasMany('App\Models\PayPointRecord');
    }
    /**
     * 取得民眾下的兌換券紀錄
     */
    public function VoucherRecord()
    {
        return $this->hasMany('App\Models\MemberUsedVoucherRecord');
    }
}
