<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class UsingFloor extends Model
{
    use HasTranslations,HasFactory;
    public $translatable = ['floor','using'];
    protected $fillable = [
        'floor',
        'using',
        'value'
    ];
}
