<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consultant extends Model
{
    use HasFactory;
    protected $fillable = [
        // 'id',
        'name',
        'email',
        'job_title',
        'phone_number',
        'rate',
        'image',

    ];

    public function review(){
        return $this->hasMany(review::class);
    }
}
