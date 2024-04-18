<?php

namespace App\Http\Controllers\Clients\Consultants;

use App\Http\Controllers\Controller;
use App\Http\Resources\Clients\Consultants\ConsultantInfoResource;
use App\Models\consultant;
use Illuminate\Http\Request;

class ConsultantsController extends Controller
{
    public function index()
    {
        $consultants = consultant::all();

        return ConsultantInfoResource::collection($consultants);
    }
}
