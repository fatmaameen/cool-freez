<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class type extends Model
{
    use HasTranslations,HasFactory;
    public $translatable = ['type'];
    protected $fillable = [
        'id',
        'type',
    ];
}
