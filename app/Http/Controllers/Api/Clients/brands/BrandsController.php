<?php

namespace App\Http\Controllers\Api\Clients\brands;

use App\Http\Controllers\Controller;
use App\Models\brand;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    public function index()
    {
        $brands = brand::all();
        return response()->json($brands);
    }
}
