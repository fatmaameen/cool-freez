<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class company extends Model
{
    use HasFactory,HasTranslations;

    public $translatable = ['name'];
    protected $fillable = [
        'name',
        'address',
        'phone',
    ];

    public function maintenance(){
        return $this->hasMany(Maintenance::class);
    }

    public function technician(){
        return $this->hasMany(technician::class);
    }

    public function admin(){
        return $this->hasMany(User::class);
    }
}
