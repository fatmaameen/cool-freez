<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cfmRate extends Model
{
    use HasFactory;
    protected $fillable = [
        'poor_from',
        'poor_to',
        'good_from',
        'good_to',
        'excellent_from',
        'excellent_to',
    ];
}
