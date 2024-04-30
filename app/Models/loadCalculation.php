<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loadCalculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'client_id',
        'service_id',
        'model_id',
        'admin_status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function service()
    {
        return $this->belongsTo(service::class);
    }

    public function model()
    {
        return $this->belongsTo(DataSheet::class);
    }
}
