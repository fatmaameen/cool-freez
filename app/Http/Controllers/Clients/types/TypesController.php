<?php

namespace App\Http\Controllers\Clients\types;

use App\Http\Controllers\Controller;
use App\Models\type;
use Illuminate\Http\Request;

class TypesController extends Controller
{
    public function index()
    {
        $types = type::all();
        return response()->json($types);
    }
}
