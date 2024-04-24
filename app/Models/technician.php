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
        'role_id',
        'email',
        'email_confirmation_token',
        'password',
        'phone_number',
        'phone_confirmation_token',
        'phone_confirmed',
        'image',
        'is_active',
        'is_banned'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function maintenance(){
        return $this->hasMany(Maintenance::class);
    }
}
