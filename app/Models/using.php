<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class using extends Model
{
    use HasFactory;

    protected $fillable = [
        'using_name',
    ];
}
