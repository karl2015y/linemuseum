<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayPointRecord extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * 取得所屬商家
     */
    public function Shop()
    {
        return $this->belongsTo('App\Models\Shop');
    }
    /**
     * 取得所屬民眾
     */
    public function Member()
    {
        return $this->belongsTo('App\Models\Member');
    }
    /**
     * 取得知識點活動的Qrcode
     */
    public function Qrcode()
    {
        return $this->hasOne('App\Models\Qrcode','ppr_id');
    }

}
