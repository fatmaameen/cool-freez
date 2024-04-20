<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pricing extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'code',
        'admin_status',
        'service_id',
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function details(){
        return $this->hasMany(pricingDetail::class);
    }
}
