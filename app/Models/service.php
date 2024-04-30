<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class service extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_name',
        'cover',
    ];

    public function pricing()
    {
        return $this->hasMany(pricing::class);
    }

    public function review()
    {
        return $this->hasMany(review::class);
    }

    public function maintenance()
    {
        return $this->hasMany(Maintenance::class);
    }

    public function loadCalculation()
    {
        return $this->hasMany(loadCalculation::class);
    }
}
