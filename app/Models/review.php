<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    use HasFactory;
    protected $fillable=[
        'code',
        'client_id',
        'consultant_id',
        'building_files',
        'admin_status',
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function consultant(){
        return $this->belongsTo(consultant::class);
    }
}
