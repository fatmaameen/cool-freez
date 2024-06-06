<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class technician extends Authenticatable
{
    use HasApiTokens,Notifiable;

    protected $fillable = [
        'name',
        'company_id',
        'email',
        'email_confirmation_token',
        'password',
        'phone_number',
        'rate',
        'phone_confirmation_token',
        'phone_confirmed',
        'image',
        'device_token',
        'is_active',
        'is_banned'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function maintenance(){
        return $this->hasMany(Maintenance::class);
    }

    public function company()
    {
        return $this->belongsTo(company::class);
    }
}
