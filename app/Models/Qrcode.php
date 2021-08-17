<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;


class Qrcode extends Model
{
    use HasFactory;
    use Uuids;
    public $incrementing = false;
    public function ka(){
        return $this->belongsTo('App\Models\KnowledgeActivity');
    }
    public function ppr(){
        return $this->belongsTo('App\Models\PayPointRecord');
    }


}
