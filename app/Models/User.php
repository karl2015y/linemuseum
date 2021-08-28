<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // 總管人員
    public function Staff()
    {
        return $this->hasOne('App\Models\Staff');
    }
    // 館舍
    public function Museum()
    {
        return $this->hasOne('App\Models\Museum');
    }
    // 商家
    public function Shop()
    {
        return $this->hasOne('App\Models\Shop');
    }
    // 民眾
    public function Member()
    {
        return $this->hasOne('App\Models\Member');
    }
}
