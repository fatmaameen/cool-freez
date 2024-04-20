<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pricingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'pricing_id',
        'building_type',
        'floor',
        'brand',
        'air_conditioning_type',
        'drawing_of_building',
    ];

    public function pricing(){
        return $this->belongsTo(pricing::class);
    }
}
