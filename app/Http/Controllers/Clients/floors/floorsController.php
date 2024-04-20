<?php

namespace App\Http\Controllers\Clients\floors;

use App\Http\Controllers\Controller;
use App\Models\floor;
use Illuminate\Http\Request;

class floorsController extends Controller
{
    public function index()
    {
        $floors = floor::all();
        return response()->json($floors);
    }
}
