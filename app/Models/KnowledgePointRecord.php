<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KnowledgePointRecord extends Model
{
    use HasFactory;
    /**
     * 取得所屬知識活動
     */
    public function KnowledgeActivity()
    {
        return $this->belongsTo('App\Models\KnowledgeActivity', 'knowledge_activity_id');
    }
    /**
     * 取得所屬民眾
     */
    public function Member()
    {
        return $this->belongsTo('App\Models\Member');
    }
    /**
     * 館舍名稱
     */
    public function Museum()
    {
        // https://stackoverflow.com/questions/23365905/laravel-hasmanythrough-equivalent-belongsto-relationship-through-another-model
        // return $this->hasOneThrough('App\Models\Museum', 'App\Models\KnowledgeActivity', 'id', 'id', 'museum_id', 'knowledge_activity_id');
        return $this->KnowledgeActivity->Museum;
    }

}
