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
        'job_title',
        'email',
        'phone_number',
        'image',
        'rate',
    ];

    public function review(){
        return $this->hasMany(review::class);
    }
}
