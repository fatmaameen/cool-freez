<?php

namespace App\Http\Controllers\Api\Clients\offers;

use App\Models\offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OffersController extends Controller
{
    public function index()
    {
        $offers = offer::all();
        return response()->json($offers);
    }

}
