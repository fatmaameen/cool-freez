<?php

namespace App\Http\Controllers\Dashboard\MainDashboard\cfmRates;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\MainDashboard\cfmRates\cfmRatesRequest;
use App\Models\cfmRate;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class AdminCfmRatesController extends Controller
{
    public function index()
    {
        $data = cfmRate::first();
        return response()->json($data);
    }

    public function update(cfmRatesRequest $request, cfmRate $rate)
    {
        try {
            $data = $request->Validated();
            $rate->update($data);
            return response()->json(['message' => 'updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'something went wrong', 'errors' => $e->getMessage()]);
        }
    }
}
