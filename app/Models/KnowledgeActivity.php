<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KnowledgeActivity extends Model
{
    use HasFactory;
    /**
     * 新增人
     */
    public function CreatedMember()
    {
        return $this->belongsTo('App\Models\Staff', 'created_staff_id');
    }
    /**
     * 更改人
     */
    public function UpdatedMember()
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

}
