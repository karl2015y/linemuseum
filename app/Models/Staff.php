<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $guarded = [];
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
}
