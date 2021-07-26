<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Museum extends Model
{
    use HasFactory;
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
     * 取得館舍下的知識點活動
     */
    public function KnowledgeActivities()
    {
        return $this->hasMany('App\Models\KnowledgeActivity');
    }
    
    /**
     * 取得館舍下的商家
     */
    public function Shops()
    {
        return $this->hasMany('App\Models\Shop');
    }

}
