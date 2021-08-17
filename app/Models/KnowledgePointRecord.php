<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KnowledgePointRecord extends Model
{
    use HasFactory;
    protected $guarded = [];
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


}
