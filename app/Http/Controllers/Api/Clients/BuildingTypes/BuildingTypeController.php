<?php

namespace App\Http\Controllers\Api\Clients\BuildingTypes;

use App\Http\Controllers\Controller;
use App\Models\BuildingType;
use Illuminate\Http\Request;

class BuildingTypeController extends Controller
{
    public function index()
    {
        $BuildingTypes = BuildingType::all();
        return response()->json($BuildingTypes);
    }
}
