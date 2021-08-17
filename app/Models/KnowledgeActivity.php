<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KnowledgeActivity extends Model
{
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
     * 取得所屬館舍
     */
    public function Museum()
    {
        return $this->belongsTo('App\Models\Museum');
    }
    /**
     * 取得知識點活動下的紀錄
     */
    public function KnowledgeActivityRecord()
    {
        return $this->hasMany('App\Models\KnowledgePointRecord','knowledge_activity_id');
    }
    /**
     * 取得知識點活動下的最新紀錄
     */
    public function SomeMemberLatestKnowledgeActivityRecord($member_id)
    {
        return $this->hasOne('App\Models\KnowledgePointRecord','knowledge_activity_id')->where('member_id',$member_id)->latest()->first();
    }



    /**
     * 取得知識點活動的Qrcode
     */
    public function Qrcode()
    {
        return $this->hasOne('App\Models\Qrcode','ka_id');
    }

}
