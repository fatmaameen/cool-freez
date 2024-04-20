<?php

namespace App\Http\Controllers\Clients\usings;

use App\Http\Controllers\Controller;
use App\Models\using;
use Illuminate\Http\Request;

class usingsController extends Controller
{
    public function index()
    {
        $usings = using::all();
        return response()->json($usings);
    }
}
