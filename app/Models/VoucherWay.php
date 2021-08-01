<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherWay extends Model
{
    protected $guarded = [];
    use HasFactory;
    /**
     * 所屬兌換券
     */
    public function Voucher()
    {
        return $this->belongsTo('App\Models\Voucher');
    }
}
