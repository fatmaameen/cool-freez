<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Maintenance extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'code',
        'client_id',
        'service_id',
        'address',
        'street_address',
        'lat',
        'long',
        'phone_number',
        'brand',
        'device_type',
        'type_of_malfunction',
        'company_id',
        'admin_status',
        'company_status',
        'technical_id',
        'technical_status',
        'expected_service_date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function technician()
    {
        return $this->belongsTo(technician::class);
    }

    public function service()
    {
        return $this->belongsTo(service::class);
    }

    public function company()
    {
        return $this->belongsTo(company::class);
    }
}
