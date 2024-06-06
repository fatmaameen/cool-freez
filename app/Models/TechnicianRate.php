<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicianRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'technician_id',
        'rate',
    ];
}
