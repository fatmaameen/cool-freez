<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'type',
        'model',
        'btu',
        'cfm',
        'gas',
        'made_in',
    ];
}
