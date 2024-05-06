<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class brand extends Model
{
    use HasTranslations,HasFactory;
    public $translatable = ['brand'];
    protected $fillable = [
        'id',
        'brand',
    ];
}
