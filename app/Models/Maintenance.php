<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Maintenance extends Model
{
    use HasFactory,Notifiable;

    protected $fillable=[
        'code',
        'client_id',
        'address',
        'street_address',
        'phone_number',
        'device_type',
        'type_of_malfunction',
        'admin_status',
        'company_status',
        'technical',
        'technical_status',
        'assigned',
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }
}
