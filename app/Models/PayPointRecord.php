<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayPointRecord extends Model
{
    use HasFactory;
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
     * 館舍名稱
     */
    public function Museum()
    {
        // https://stackoverflow.com/questions/23365905/laravel-hasmanythrough-equivalent-belongsto-relationship-through-another-model
        // return $this->hasOneThrough('App\Models\Museum', 'App\Models\Shop', 'id', 'id', 'shop_id', 'museum_id');
        return $this->Shop->Museum;
    }

}
