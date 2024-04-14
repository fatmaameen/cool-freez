<?php

namespace App\Http\Controllers\Clients\services;

use App\Http\Controllers\Controller;
use App\Models\service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        $services = service::all();
        return response()->json($services);
    }
}
